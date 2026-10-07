<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::where('status', 'available')->get();

        $reservations = Reservation::whereIn(
            'status',
            ['pending', 'approved']
        )
            ->get([
                'reservation_id',
                'facility_id',
                'reservation_date',
                'start_time',
                'end_time',
                'status'
            ]);

        return view('fasilitas', compact(
            'facilities',
            'reservations'
        ));
    }
}