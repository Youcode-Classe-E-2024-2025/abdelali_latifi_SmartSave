<?php

namespace App\Http\Controllers;

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

    return view('home', compact('profile', 'goals', 'transactions'));
}
    
}
