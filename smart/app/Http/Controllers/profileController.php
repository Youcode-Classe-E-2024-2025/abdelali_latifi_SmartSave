<?php

namespace App\Http\Controllers;

use App\Models\Profile;

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
}
