<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Transaction;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer les objectifs financiers de l'utilisateur
        $goals = Goal::where('user_id', auth()->id())->get();

        // Récupérer les 5 dernières transactions de l'utilisateur
        $transactions = Transaction::where('user_id', auth()->id())->latest()->take(5)->get();

        // Passer les variables à la vue
        return view('home', compact('goals', 'transactions'));
    }
}
