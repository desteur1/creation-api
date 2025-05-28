<?php




use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReservationController;

// Routes API pour les utilisateurs, catégories, événements et réservations
Route::apiResource('users', UserController::class);
//génère automatiquement les toutes les routes RESTful pour le modèle User
Route::apiResource('categories', CategoryController::class);
//génère automatiquement les toutes les routes RESTful pour le modèle Event
Route::apiResource('events', EventController::class);
//génère automatiquement les toutes les routes RESTful pour le modèle Reservation
Route::apiResource('reservations', ReservationController::class);