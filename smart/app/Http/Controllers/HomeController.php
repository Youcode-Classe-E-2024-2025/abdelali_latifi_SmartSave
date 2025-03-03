<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Transaction;
use App\Models\profile;


class HomeController extends Controller
{

    public function index($id)
{
    $profile = Profile::findOrFail($id); // Récupérer le profil avec l'ID
    $goals = Goal::all(); // Récupérer tous les objectifs financiers
    $transactions = Transaction::latest()->get(); // Récupérer toutes les transactions, triées par date
    $categories = Category::where('user_id', session('user_id'))->get(); // Récupérer les catégories de l'utilisateur connecté
    return view('home', compact('profile', 'goals', 'transactions', 'categories'));
}
    
}
