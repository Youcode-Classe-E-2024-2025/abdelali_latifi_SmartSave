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
    $goals = Goal::where('user_id', $id)->get();
    $transactions = Transaction::where('user_id', $id)->orderBy('created_at', 'desc')->get();

    return view('home', compact('profile', 'goals', 'transactions'));
}
    
}
