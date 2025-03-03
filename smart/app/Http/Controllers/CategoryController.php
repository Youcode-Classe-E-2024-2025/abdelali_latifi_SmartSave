<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Afficher le formulaire d'ajout de catégorie
    public function create()
    {
        return view('create_category');
    }

    // Enregistrer une nouvelle catégorie
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories',
        ]);

        $profile = auth()->user()->profiles()->first(); // Récupérer le premier profil de l'utilisateur
        if (!$profile) {
            return redirect()->route('welcome')->with('error', 'Aucun profil trouvé.');
        }
    
        Category::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);
    
        return redirect()->route('home', ['id' => $profile->id]);
    }

    // Afficher les catégories sur la page home
    public function index()
    {
        $categories = Category::all(); // Récupérer toutes les catégories
        return view('home', compact('categories')); // Passer la variable à la vue
    }
    

    
}
