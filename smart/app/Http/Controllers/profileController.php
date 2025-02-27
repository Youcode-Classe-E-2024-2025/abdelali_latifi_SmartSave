<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;  // Assure-toi d'importer la classe Request
use Illuminate\Support\Facades\Storage; 

class ProfileController extends Controller
{
    /**
     * Afficher la liste des profils.
     */
    public function index()
    {
        // Récupérer tous les profils avec leurs utilisateurs associés
        $profiles = Profile::with('user')->get();

        // Passer les profils à la vue
        return view('profiles', compact('profiles'));
    }

    public function create()
    {
        // Récupérer tous les utilisateurs pour l'assigner au profil
        $users = User::all();
        return view('profiles_create', compact('users'));
    }

    // Sauvegarder le profil dans la base de données
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'required|image',
        ]);
        

        // Stocker l'image et obtenir son chemin
        $imagePath = $request->file('img')->store('profiles', 'public');

        // Créer le profil
        Profile::create([
            'name' => $validated['name'],
            'img' => $imagePath,
            'user_id' => session('user_id'),
        ]);
        
        return redirect()->route('profiles')->with('success', 'Profil ajouté avec succès.');
    }
}
