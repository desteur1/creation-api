<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
      public function index(Request $request)
    {
        $query = Reservation::with(['user', 'event']);// Charge les relations 'user' et 'event'si elles existent

        // Filtre par utilisateur si un paramètre 'user_id' est passé
        if ($request->has('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        // Filtre par événement si un paramètre 'event_id' est passé
        if ($request->has('event_id')) {
            $query->where('event_id', $request->input('event_id'));
        }

        // Filtre par statut si un paramètre 'status' est passé
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filtre par date de réservation si un paramètre 'reservation_date' est passé
        if ($request->has('reservation_date')) {
            $query->whereDate('created_at', $request->input('reservation_date'));
        }


        // Liste toutes les réservations avec l'utilisateur et l'événement liés
        return $query->paginate(10);
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'event_id' => 'required|exists:events,id',
        'status' => 'nullable|string', // par ex. "confirmed", "cancelled"
        'places_reserved' => 'required|integer|min:1',
    ]);

    // Ajoute l'ID de l'utilisateur connecté
    $validated['user_id'] = Auth::id();

    $reservation = Reservation::create($validated);

    return response()->json($reservation, 201);
}

    public function show(Reservation $reservation)
    {
        // Affiche une réservation avec les relations
        return $reservation->load(['user', 'event']);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => 'sometimes|required|string',
        ]);

        $reservation->update($validated);
        return $reservation;
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(null, 204);
    }
    public function getByEvent($event_id)
{
    $reservations = Reservation::where('event_id', $event_id)
        ->with('user') // optionnel : ajoute les infos de l'utilisateur
        ->get();

    return response()->json($reservations);
}





}
