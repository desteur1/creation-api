<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Affiche la liste de tous les événements avec leur catégorie associée
    public function index(Request $request)
    {

        $query = Event::with('category');

        // Filtre par catégorie si un paramètre 'category_id' est passé
        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Filtre par mot-clé dans le titre ou la description
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");

            });
        }
        // filtre par date précise (ex: start_time = date)
        if ($request->has('date')) {
            $query->whereDate('start_time', $request->date);
        }
        // Filtre par intervalle de date (start_date et end_date)
    if ($request->has('start_date')) {
        $query->whereDate('start_time', '>=', $request->input('start_date'));
    }
    if ($request->has('end_date')) {
        $query->whereDate('start_time', '<=', $request->input('end_date'));
    }

    // Filtre par lieu (location)
    if ($request->has('location')) {
        $location = $request->input('location');
        $query->where('location', 'LIKE', "%{$location}%");
    }

    // Filtre par statut
    if ($request->has('status')) {
        $query->where('status', $request->input('status'));
    }

        // Retourne les événements paginés (10 par page)
        return $query->paginate(10);
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
