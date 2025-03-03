<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FinancialController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;

// Accueil
Route::get('/', function () {
    return view('welcome');
});
Route::get( '/welcome', function () {
    return view('welcome');
})->name('welcome');

// Authentification
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profils
Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles');
Route::get('/profiles_create', [ProfileController::class, 'create'])->name('profiles.create');
Route::post('/profiles_create', [ProfileController::class, 'store'])->name('profiles.store');

// Page d'accueil après connexion   
Route::get('/home/{id}', [HomeController::class, 'index'])->name('home');

// Routes financières
Route::middleware('auth')->group(function () {
    // Création des objectifs et transactions
    Route::get('/create-transaction', [FinancialController::class, 'createTransaction'])->name('financial.createTransaction');
    Route::post('/store-transaction', [FinancialController::class, 'storeTransaction'])->name('financial.storeTransaction');
    Route::get('/create-goal', [FinancialController::class, 'createGoal'])->name('financial.createGoal');
    Route::post('/store-goal', [FinancialController::class, 'storeGoal'])->name('financial.storeGoal');
    Route::get('/goals', [FinancialController::class, 'showGoals'])->name('financial.showGoals');
    
    // Modification et suppression des objectifs financiers
    Route::get('/goal/{id}/edit', [FinancialController::class, 'editGoal'])->name('financial.editGoal');
    Route::put('/goal/{id}', [FinancialController::class, 'updateGoal'])->name('financial.updateGoal');
    Route::delete('/goal/{id}', [FinancialController::class, 'deleteGoal'])->name('financial.deleteGoal');

    // Modification et suppression des transactions
    Route::get('/transaction/{id}/edit', [FinancialController::class, 'editTransaction'])->name('financial.editTransaction');
    Route::put('/transaction/{id}', [FinancialController::class, 'updateTransaction'])->name('financial.updateTransaction');
    Route::delete('/transaction/{id}', [FinancialController::class, 'deleteTransaction'])->name('financial.deleteTransaction');
});


Route::get('create_category', [CategoryController::class, 'create'])->name('categories.create');

// Enregistrer une nouvelle catégorie
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
// Supprimer une catégorie
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

