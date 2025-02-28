<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get( '/welcome', function () {
    return view('welcome');
})->name('welcome');
// auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 

Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles');
Route::get('/profiles_create', [ProfileController::class, 'create'])->name('profiles.create');
Route::post('/profiles_create', [ProfileController::class, 'store'])->name('profiles.store');

//

Route::get('/home/{id}', [HomeController::class, 'index'])->name('home');

use App\Http\Controllers\FinancialController;

Route::middleware('auth')->group(function () {
    Route::get('/create-transaction', [FinancialController::class, 'createTransaction']);
    Route::post('/store-transaction', [FinancialController::class, 'storeTransaction'])->name('financial.storeTransaction');
    Route::get('/create-goal', [FinancialController::class, 'createGoal']);
    Route::post('/store-goal', [FinancialController::class, 'storeGoal'])->name('financial.storeGoal');
    Route::get('/goals', [FinancialController::class, 'showGoals']);
});

//
Route::get('/create-goal', [FinancialController::class, 'createGoal'])->name('financial.createGoal');
Route::get('/create-transaction', [FinancialController::class, 'createTransaction'])->name('financial.createTransaction');

