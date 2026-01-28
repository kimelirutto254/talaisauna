<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaunaSessionController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate
        $request->validate([
            'sauna_id' => 'required|exists:saunas,id',
            'customer_name' => 'nullable|string',
            'phone' => 'nullable|string',
            'duration' => 'required|integer|min:15',
            'pricing_rule_id' => 'nullable|exists:pricing_rules,id', // Make nullable for backward compatibility, but ideally required
        ]);

        $user = auth()->user();
        if (!$user->branch_id) {
            return back()->with('error', 'You must be assigned to a branch.');
        }

        // 2. Find or Create Customer
        $customer = null;
        if ($request->customer_name) {
            $customer = \App\Models\Customer::firstOrCreate(
                ['phone' => $request->phone],
                ['name' => $request->customer_name]
            );
            $customer->increment('visits_count');
        }

        // 3. Calculate Cost
        $sauna = \App\Models\Sauna::findOrFail($request->sauna_id);
        $totalAmount = 0;

        if ($request->pricing_rule_id) {
            $rule = \App\Models\PricingRule::find($request->pricing_rule_id);
            if ($rule) {
                if ($rule->price_type == 'flat') {
                    $totalAmount = $rule->price;
                } elseif ($rule->price_type == 'per_person') {
                    $totalAmount = $rule->price; // Times 1 person
                } elseif ($rule->price_type == 'per_hour') {
                    $hours = max($request->duration / 60, 0.5); // Minimum 30 mins logic if needed
                    $totalAmount = $rule->price * $hours;
                }
            }
        } else {
            // Fallback to sauna default price if no rule selected (legacy/simple mode)
            $totalAmount = $sauna->price ?? 0;
        }
        
        // 4. Create Session
        $session = \App\Models\Session::create([
            'branch_id' => $user->branch_id,
            'sauna_id' => $sauna->id,
            'pricing_rule_id' => $request->pricing_rule_id,
            'customer_id' => $customer?->id,
            'user_id' => $user->id,
            'status' => 'active',
            'start_time' => now(),
            'expected_end_time' => now()->addMinutes($request->duration),
            'total_amount' => $totalAmount,
        ]);

        // 5. Create Checkin Record
        \App\Models\Checkin::create([
            'session_id' => $session->id,
            'checked_in_at' => now(),
            'attendant_id' => $user->id,
        ]);

        return back()->with('success', 'Customer checked in successfully! Session #' . $session->id . ' started. Total Due: KES ' . number_format($totalAmount, 2));
    }

    public function recordPayment(Request $request, $sessionId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'method' => 'required|in:cash,mpesa,card',
            'reference' => 'nullable|string',
        ]);

        $session = \App\Models\Session::findOrFail($sessionId);
        
        \App\Models\Payment::create([
            'session_id' => $session->id,
            'amount' => $request->amount,
            'method' => $request->method,
            'reference' => $request->reference,
            'received_by' => auth()->id(),
            'status' => 'completed',
        ]);
        
        // Auto-record as transaction for the dashboard financial stats
        \App\Models\Transaction::create([
            'branch_id' => $session->branch_id,
            'user_id' => auth()->id(),
            'type' => 'income',
            'amount' => $request->amount,
            'date' => now(),
            'description' => 'Session #' . $session->id . ' Payment (' . $request->method . ')',
        ]);

        return back()->with('success', 'Payment recorded.');
    }

    public function checkout($sessionId)
    {
        $session = \App\Models\Session::findOrFail($sessionId);
        $actualEndTime = now();
        $overtimeFee = 0;

        // Check for overtime
        if ($session->expected_end_time && $actualEndTime->gt($session->expected_end_time->addMinutes(10))) {
            // Overtime duration in minutes
            $overtimeMinutes = $session->expected_end_time->diffInMinutes($actualEndTime);
            
            // Calculate fee based on pricing rule
            if ($session->pricingRule && $session->pricingRule->price_type == 'per_hour') {
                $pricePerMinute = $session->pricingRule->price / 60;
                $overtimeFee = $overtimeMinutes * $pricePerMinute;
            }
        }

        $session->update([
            'status' => 'completed',
            'actual_end_time' => $actualEndTime,
            'overtime_fee' => $overtimeFee,
            'total_amount' => $session->total_amount + $overtimeFee,
        ]);
        
        if ($session->checkin) {
            $session->checkin->update(['checked_out_at' => $actualEndTime]);
        }

        $message = 'Session completed. Customer checked out.';
        if ($overtimeFee > 0) {
            $message .= ' Overtime fee of KES ' . number_format($overtimeFee, 2) . ' applied.';
        }

        return back()->with('success', $message);
    }
}
