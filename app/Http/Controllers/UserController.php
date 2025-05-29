<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  
    // Afficher la liste des utilisateurs (ex: pour admin)
    public function index(Request $request)
    {

        $query = User::query();

     

        // Filtre par adresse e-mail exacte
        if ($request->has('email')) {
            $query->where('email', $request->email);
        }

        // recherche partielle dans le nom ou l'adresse e-mail
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
                });

        }

        // Filtre les utilisateurs créés après une certaine date
        if ($request->has('created_after')) {
            $query->whereDate('created_at', '>=', $request->created_after);
        }

        // Filtre les utilisateurs créés avant une certaine date
        if ($request->has('created_before')) {
            $query->whereDate('created_at', '<=', $request->created_before);
        }


        return $query->paginate(10);
    }

    // Afficher un utilisateur précis
    public function show(User $user)
    {
        return $user;
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    return response()->json($user, 201);
}


    // Mise à jour d’un utilisateur
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8|confirmed',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return $user;
    }

    // Supprimer un utilisateur
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
