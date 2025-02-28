<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Goal;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    // Afficher le formulaire pour ajouter une transaction
    public function createTransaction()
    {
        $goals = Goal::all(); // Récupérer tous les objectifs pour les lier à une transaction
        return view('create_transaction', compact('goals'));
    }

    // Ajouter une transaction
    public function storeTransaction(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'goal_id' => 'nullable|exists:goals,id',
        ]);

        Transaction::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'goal_id' => $request->goal_id,
        ]);

        return redirect()->route('home'); // Rediriger vers la page du tableau de bord ou autre
    }

    // Afficher le formulaire pour ajouter un objectif
    public function createGoal()
    {
        return view('create_goal');
    }

    // Ajouter un objectif
    public function storeGoal(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'target_amount' => 'required|numeric',
        ]);

        Goal::create([
            'name' => $request->name,
            'target_amount' => $request->target_amount,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('home');
    }

    // Afficher tous les objectifs financiers et les transactions associées
    public function showGoals()
    {
        $goals = Goal::where('user_id', auth()->id())->with('transactions')->get();
        return view('goals', compact('goals'));
    }
}
