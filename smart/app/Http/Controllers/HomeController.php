<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Transaction;
use App\Models\Profile;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index($id)
    {
        $profile = Profile::findOrFail($id);
        
        // Statistiques détaillées
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Calculs des statistiques
        $totalIncome = Transaction::where('user_id', auth()->id())
            ->where('type', 'income')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $totalExpenses = Transaction::where('user_id', auth()->id())
            ->where('type', 'expense')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $goals = Goal::where('user_id', auth()->id())
            ->get()
            ->map(function($goal) {
                // Calcul du montant actuel en se basant sur les transactions liées
                $goal->current_amount = Transaction::where('goal_id', $goal->id)
                    ->where('type', 'income')
                    ->sum('amount');
                return $goal;
            });

        $transactions = Transaction::where('user_id', auth()->id())
            ->latest()
            ->take(10) // Limiter à 10 transactions récentes
            ->get();

        $categories = Category::where('user_id', auth()->id())->get();

        // Statistiques supplémentaires
        $monthlyStats = [
            'total_income' => $totalIncome,
            'total_expenses' => $totalExpenses,
            'net_balance' => $totalIncome - $totalExpenses,
            'income_transactions_count' => Transaction::where('user_id', auth()->id())
                ->where('type', 'income')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count(),
            'expense_transactions_count' => Transaction::where('user_id', auth()->id())
                ->where('type', 'expense')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count(),
        ];

        return view('home', compact(
            'profile', 
            'goals', 
            'transactions', 
            'categories', 
            'monthlyStats'
        ));
    }
}