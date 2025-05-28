<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Affiche la liste de tous les événements avec leur catégorie associée
    public function index()
    {
        return Event::with('category')->get();
    }
    // Crée un nouvel événement
    public function store(Request $request)
    {   // Validation des données reçues
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'location' => 'required|string',
            'category_id' => 'required|exists:categories,id',]);

        // Création de l'événement
        return Event::create($validated);
            
        }

        // Affiche un événement spécifique avec sa catégorie
    public function show(Event $event)

    {
        
        return $event->load('category');
    }
    // Met à jour un événement existant
    public function update(Request $request, Event $event)
    {
        // Validation des données reçues
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|required|string',
             'start_time' => 'sometimes|required|date',
            'location' => 'sometimes|required|string',
            'category_id' => 'sometimes|required|exists:categories,id',]);

        // Mise à jour de l'événement
        $event->update($validated);
        return $event;
    }
    // Supprime un événement
    public function destroy(Event $event)
    {
      
        $event->delete();
        return response()->json(null, 204);
    }
}
