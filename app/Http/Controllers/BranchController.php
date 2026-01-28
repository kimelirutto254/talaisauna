<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::withCount(['users', 'saunas'])->latest()->get();
        return view('branches.index', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Branch::create($validated);

        return redirect()->route('branches.index')->with('success', 'Branch created successfully.');
    }

    public function destroy(Branch $branch)
    {
        // Check if branch has users or saunas
        if ($branch->users()->count() > 0 || $branch->saunas()->count() > 0) {
            return redirect()->route('branches.index')->with('error', 'Cannot delete branch with existing users or saunas.');
        }

        $branch->delete();
        return redirect()->route('branches.index')->with('success', 'Branch deleted successfully.');
    }
}
