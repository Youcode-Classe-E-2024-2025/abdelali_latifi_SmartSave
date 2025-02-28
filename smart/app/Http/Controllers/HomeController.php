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
        $goals = Goal::where('user_id', $id)->get(); // Récupère les objectifs liés à l'utilisateur
        $transactions = Transaction::where('user_id', $id)->orderBy('created_at', 'desc')->get(); // Récupère les transactions
    
        return view('home', compact('goals', 'transactions'));
    }

    
}
