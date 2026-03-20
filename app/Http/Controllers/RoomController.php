<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with(['reservations' => function($query) {
            $query->orderBy('date')
                  ->orderBy('start_time');
                  #on peut ajouter cette condition
                  #->where('date', '>=', now()->format('Y-m-d')
                
        }])->get();
        
        // Vérifiez que la vue existe
        return view('rooms.index', compact('rooms'));
    }

    public function store(Request $request)
    #fonction store pour gérer la création d'une nouvelle réservation
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required|exists:rooms,id',
            'user_name' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], [
            'end_time.after' => 'L\'heure de fin doit être postérieure à l\'heure de début.',
            'date.after_or_equal' => 'La date doit être aujourd\'hui ou ultérieure.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('rooms.index')
                ->withErrors($validator)
                ->withInput();
        }

        $room = Room::findOrFail($request->room_id);

        if (!$room->isAvailable($request->date, $request->start_time, $request->end_time)) {
            return redirect()->route('rooms.index')
                ->with('error', 'Cette salle est déjà réservée sur ce créneau horaire ou sur une partie de ce créneau.')
                ->withInput();
        }

        Reservation::create([
            'room_id' => $request->room_id,
            'user_name' => $request->user_name,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('rooms.index')
            ->with('success', 'Réservation effectuée avec succès !');
    }
}