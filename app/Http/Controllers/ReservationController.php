<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create()
    {
        $facilities = Facility::where('status', 'available')->get();

        return view('reservasi', compact('facilities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'facility_id' => 'required|exists:facilities,facility_id',
            'reservation_date' => 'required|date',
            'start_time' => [
                'required',
                'date_format:H:i',
                'after_or_equal:07:00',
                'before_or_equal:19:30',
            ],
            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
                'after_or_equal:07:30',
                'before_or_equal:20:00',
            ],
            'purpose' => 'required|string|max:1000',
        ], [
            'facility_id.required' => 'Silakan pilih fasilitas.',
            'facility_id.exists' => 'Fasilitas tidak ditemukan.',
            'reservation_date.required' => 'Tanggal harus dipilih.',
            'start_time.required' => 'Waktu mulai harus diisi.',
            'end_time.required' => 'Waktu selesai harus diisi.',
            'end_time.after' => 'Waktu selesai harus setelah waktu mulai.',
            'purpose.required' => 'Tujuan penggunaan harus diisi.',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),
            'facility_id' => $validated['facility_id'],
            'reservation_date' => $validated['reservation_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'purpose' => $validated['purpose'],
            'status' => 'pending',
        ]);

        return redirect()
            ->route('reservasi')
            ->with('success', 'Reservasi berhasil diajukan.');
    }
}