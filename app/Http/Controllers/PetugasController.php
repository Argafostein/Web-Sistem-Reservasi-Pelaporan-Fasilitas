<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

class PetugasController extends Controller
{
    public function dashboard()
    {
        $pendingReservations = Reservation::where('status', 'pending')
            ->with(['user', 'facility'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('petugas.dashboard', compact(
            'pendingReservations'
        ));
    }
}