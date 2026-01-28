<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Helper to get last 7 days dates
        $dates = collect();
        for ($i = 6; $i >= 0; $i--) {
            $dates->push(now()->subDays($i)->format('Y-m-d'));
        }

        if ($user->role === 'admin') {
            $branches = \App\Models\Branch::with(['transactions' => function($q) {
                $q->latest()->limit(5);
            }])->get();
            
            $totalIncome = \App\Models\Transaction::where('type', 'income')->sum('amount');
            $totalExpense = \App\Models\Transaction::where('type', 'expense')->sum('amount');
            $profit = $totalIncome - $totalExpense;

            // Chart Data for Admin (All Branches)
            $chartData = [
                'labels' => $dates->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d')),
                'income' => [],
                'expense' => []
            ];

            foreach ($dates as $date) {
                $chartData['income'][] = \App\Models\Transaction::where('type', 'income')->whereDate('date', $date)->sum('amount');
                $chartData['expense'][] = \App\Models\Transaction::where('type', 'expense')->whereDate('date', $date)->sum('amount');
            }

            return view('dashboard.admin', compact('branches', 'totalIncome', 'totalExpense', 'profit', 'chartData'));
        }

        // Manager Logic
        $branch = $user->branch;
        
        if (!$branch) {
            abort(403, 'No branch assigned');
        }

        $transactions = $branch->transactions()->latest()->get();
        $totalIncome = $branch->transactions()->where('type', 'income')->sum('amount');
        $totalExpense = $branch->transactions()->where('type', 'expense')->sum('amount');
        $profit = $totalIncome - $totalExpense;

        // Chart Data for Manager (Specific Branch)
        $chartData = [
            'labels' => $dates->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d')),
            'income' => [],
            'expense' => []
        ];

        foreach ($dates as $date) {
            $chartData['income'][] = $branch->transactions()->where('type', 'income')->whereDate('date', $date)->sum('amount');
            $chartData['expense'][] = $branch->transactions()->where('type', 'expense')->whereDate('date', $date)->sum('amount');
        }

        // Fetch active sessions
        $activeSessions = \App\Models\Session::with(['customer', 'sauna', 'payments'])
            ->where('branch_id', $branch->id)
            ->where('status', 'active')
            ->latest()
            ->get();

        $saunas = \App\Models\Sauna::with('pricingRules')->where('branch_id', $branch->id)->get();

        return view('dashboard.branch', compact('branch', 'transactions', 'totalIncome', 'totalExpense', 'profit', 'chartData', 'activeSessions', 'saunas'));
    }
}
