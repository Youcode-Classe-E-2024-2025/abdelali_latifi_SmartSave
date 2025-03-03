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

    $profile = auth()->user()->profiles()->first(); // Récupérer le premier profil de l'utilisateur
    if (!$profile) {
        return redirect()->route('welcome')->with('error', 'Aucun profil trouvé.');
    }

    Transaction::create([
        'type' => $request->type,
        'amount' => $request->amount,
        'description' => $request->description,
        'user_id' => auth()->id(),
        'goal_id' => $request->goal_id,
    ]);

    return redirect()->route('home', ['id' => $profile->id]);
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
    
        $profile = auth()->user()->profiles()->first(); // Récupérer le premier profil de l'utilisateur
        if (!$profile) {
            return redirect()->route('welcome')->with('error', 'Aucun profil trouvé.');
        }
    
        Goal::create([
            'name' => $request->name,
            'target_amount' => $request->target_amount,
            'user_id' => auth()->id(),
        ]);
    
        return redirect()->route('home', ['id' => $profile->id]);
    }
    // Afficher tous les objectifs financiers et les transactions associées
    public function showGoals()
    {
        $goals = Goal::where('user_id', auth()->id())->with('transactions')->get();
        return view('goals', compact('goals'));
    }

    // Afficher le formulaire pour modifier un objectif
public function editGoal($id)
{
    $goal = Goal::findOrFail($id); // Récupérer l'objectif par son ID
    return view('edit_goal', compact('goal'));
}

// Mettre à jour un objectif
public function updateGoal(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string',
        'target_amount' => 'required|numeric',
    ]);

    $goal = Goal::findOrFail($id);
    $goal->update([
        'name' => $request->name,
        'target_amount' => $request->target_amount,
    ]);

    $profile = auth()->user()->profiles()->first(); // Récupérer le premier profil de l'utilisateur
    if (!$profile) {
        return redirect()->route('welcome')->with('error', 'Aucun profil trouvé.');
    }

    return redirect()->route('home', ['id' => $profile->id])->with('success', 'Objectif supprimé avec succès.');}

// Supprimer un objectif
public function deleteGoal($id)
{
    $goal = Goal::findOrFail($id);
    $goal->delete(); // Supprimer l'objectif

    $profile = auth()->user()->profiles()->first(); // Récupérer le premier profil de l'utilisateur
    if (!$profile) {
        return redirect()->route('welcome')->with('error', 'Aucun profil trouvé.');
    }

    return redirect()->route('home', ['id' => $profile->id])->with('success', 'Objectif supprimé avec succès.');
}

// Afficher le formulaire pour modifier une transaction
public function editTransaction($id)
{
    $transaction = Transaction::findOrFail($id); // Récupérer la transaction par son ID
    $goals = Goal::all(); // Récupérer tous les objectifs financiers pour associer à la transaction
    return view('edit_transaction', compact('transaction', 'goals'));
}

// Mettre à jour une transaction
public function updateTransaction(Request $request, $id)
{
    $request->validate([
        'type' => 'required|in:income,expense',
        'amount' => 'required|numeric',
        'description' => 'required|string',
        'goal_id' => 'nullable|exists:goals,id',
    ]);

    $transaction = Transaction::findOrFail($id);
    $transaction->update([
        'type' => $request->type,
        'amount' => $request->amount,
        'description' => $request->description,
        'goal_id' => $request->goal_id,
    ]);

    $profile = auth()->user()->profiles()->first(); // Récupérer le premier profil de l'utilisateur
    if (!$profile) {
        return redirect()->route('welcome')->with('error', 'Aucun profil trouvé.');
    }

    return redirect()->route('home', ['id' => $profile->id])->with('success', 'Objectif supprimé avec succès.');}

// Supprimer une transaction
public function deleteTransaction($id)
{
    $transaction = Transaction::findOrFail($id);
    $transaction->delete(); // Supprimer la transaction

    $profile = auth()->user()->profiles()->first(); // Récupérer le premier profil de l'utilisateur
    if (!$profile) {
        return redirect()->route('welcome')->with('error', 'Aucun profil trouvé.');
    }

    return redirect()->route('home', ['id' => $profile->id])->with('success', 'Transaction supprimée avec succès.');
}
}
