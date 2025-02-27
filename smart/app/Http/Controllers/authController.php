<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Affiche la page d'inscription
     */
    public function showRegister()
    {
        return view('register');
    }

    /**
     * Affiche la page de connexion
     */
    public function showLogin()
    {
        return view('login');
    }

    public function showHome()
    {
        return view('home');
    }


   /**
 * Gère l'inscription d'un utilisateur
 */
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
    ]);
    
    // Création de l'utilisateur
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('register')->with('success', 'registerd succufly');
}

    /**
     * Gère la connexion d'un utilisateur   
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->put('user_id',$user->id);
            return to_route('profiles');
        }

        return back()->withErrors(['email' => 'incorrect informations']);
    }

    /**
     * Gère la déconnexion d'un utilisateur
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'logout with succes.');
    }

    /**
     * Redirige l'utilisateur en fonction de son rôle
     */
}
