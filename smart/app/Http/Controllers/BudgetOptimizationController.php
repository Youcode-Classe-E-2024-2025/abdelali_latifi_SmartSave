<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Goal;

class BudgetOptimizationController extends Controller
{
    public function showOptimizationForm()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        $goals = Goal::where('user_id', auth()->id())->get();
        return view('budget.optimize', compact('categories', 'goals'));
    }

    public function optimizeBudget(Request $request)
    {
        $request->validate([
            'total_budget' => 'required|numeric|min:0',
            'needs_percentage' => 'required|numeric|min:0|max:100',
            'wants_percentage' => 'required|numeric|min:0|max:100',
            'savings_percentage' => 'required|numeric|min:0|max:100',
            'category_priorities' => 'nullable|array',
            'category_priorities.*' => 'exists:categories,id',
            'goal_priorities' => 'nullable|array',
            'goal_priorities.*' => 'exists:goals,id',
        ]);

        // Algorithme d'optimisation budgétaire (exemple simple)
        $totalBudget = $request->total_budget;
        $needs = $totalBudget * ($request->needs_percentage / 100);
        $wants = $totalBudget * ($request->wants_percentage / 100);
        $savings = $totalBudget * ($request->savings_percentage / 100);

        $categoryPriorities = $request->input('category_priorities', []);
        $goalPriorities = $request->input('goal_priorities', []);

        $results = [
            'total_budget' => $totalBudget,
            'needs' => $needs,
            'wants' => $wants,
            'savings' => $savings,
            'category_priorities' => $categoryPriorities,
            'goal_priorities' =>  $goalPriorities,
        ];
        // Passer les résultats à la vue
        return view('budget.results', compact('results'));
    }
}
