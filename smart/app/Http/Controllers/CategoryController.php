<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;

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
        $categories = Category::where('user_id', session('user_id'))->get(); // Récupérer les catégories de l'utilisateur connecté
        return view('home', compact('categories')); // Passer la variable à la vue
    }

    // Supprimer une catégorie
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Vérifier si l'utilisateur est propriétaire de la catégorie
        if ($category->user_id !== auth()->id()) {
            return redirect()->route('home')->with('error', 'Vous n\'avez pas l\'autorisation de supprimer cette catégorie.');
        }
        
        $category->delete();
        
        $profile = auth()->user()->profiles()->first();
        if ($profile) {
            return redirect()->route('home', ['id' => $profile->id])->with('success', 'Catégorie supprimée avec succès.');
        }
        return redirect()->route('welcome')->with('error', 'Aucun profil trouvé.');
            }
}
