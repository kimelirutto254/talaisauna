<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PricingRuleController extends Controller
{
    public function index()
    {
        $rules = \App\Models\PricingRule::with('sauna')->latest()->get();
        $saunas = \App\Models\Sauna::all();
        return view('pricing_rules.index', compact('rules', 'saunas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sauna_id' => 'required|exists:saunas,id',
            'price_type' => 'required|in:flat,per_person,per_hour',
            'price' => 'required|numeric|min:0',
        ]);

        \App\Models\PricingRule::create($validated);

        return redirect()->route('pricing-rules.index')->with('success', 'Pricing rule added successfully.');
    }

    public function destroy(\App\Models\PricingRule $pricingRule)
    {
        $pricingRule->delete();
        return redirect()->route('pricing-rules.index')->with('success', 'Pricing rule deleted successfully.');
    }
}
