<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            $transactions = \App\Models\Transaction::with(['branch', 'user'])
                ->latest('date')
                ->paginate(50);
            $branches = \App\Models\Branch::all();
        } else {
            $transactions = \App\Models\Transaction::with(['branch', 'user'])
                ->where('branch_id', $user->branch_id)
                ->latest('date')
                ->paginate(50);
            $branches = collect();
        }

        return view('transactions.index', compact('transactions', 'branches'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        $rules = [
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ];

        // If admin, they must select a branch. If manager, use their branch.
        if ($user->role === 'admin') {
            $rules['branch_id'] = 'required|exists:branches,id';
            $branchId = $request->branch_id;
        } else {
            $branchId = $user->branch_id;
        }

        $request->validate($rules);

        \App\Models\Transaction::create([
            'branch_id' => $branchId,
            'user_id' => $user->id,
            'type' => $request->type,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Transaction recorded successfully.');
    }
}
