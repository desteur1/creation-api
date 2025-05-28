<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Affiche la liste de toutes les catégories
    public function index()
    {
        
        return Category::all();
    }

     // Crée une nouvelle catégorie
    public function store(Request $request)
    {
        // Validation des données reçues
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        //  Création de la catégorie
        $category = Category::create($validated);
        // Retourne la catégorie créée avec le code 201 (créé)
        return response()->json($category, 201);
    }
//  afficher une catégorie spécifique
    public function show(Category $category)
    
    {
        
        return $category;
    }

    // Met à jour une catégorie existante
    public function update(Request $request, Category $category)
    {
        // Validation des données reçues
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',]);

           // Mise à jour de la catégorie
        $category->update($validated);
        return $category;
    }
// Supprimer une catégorie
    public function destroy(Category $category)
    {
        
        $category->delete();
        // Retourne une réponse vide avec le code 204 (pas de contenu)
        return response()->json(null,204);
    }

}
