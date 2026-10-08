<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function approveReservation(Reservation $reservation)
    {
        // Pastikan reservasi masih pending
        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Reservasi ini sudah diproses.');
        }

        // Cek apakah ada reservasi lain yang bentrok
        $overlappingReservation = Reservation::where(
                'facility_id',
                $reservation->facility_id
            )
            ->where(
                'reservation_date',
                $reservation->reservation_date
            )
            ->whereIn('status', ['pending', 'approved'])
            ->where(
                'reservation_id',
                '!=',
                $reservation->reservation_id
            )
            ->where('start_time', '<', $reservation->end_time)
            ->where('end_time', '>', $reservation->start_time)
            ->first();

        if ($overlappingReservation) {
            return back()->with(
                'error',
                'Reservasi tidak dapat disetujui karena jadwal berbenturan dengan reservasi lain.'
            );
        }

        $reservation->update([
            'status' => 'approved',
        ]);

        return back()->with(
            'success',
            'Reservasi berhasil disetujui.'
        );
    }

    public function rejectReservation(
        Request $request,
        Reservation $reservation
    ) {
        if ($reservation->status !== 'pending') {
            return back()->with(
                'error',
                'Reservasi ini sudah diproses.'
            );
        }

        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $reservation->update([
            'status' => 'rejected',
            'reason' => $request->reason,
        ]);

        return back()->with(
            'success',
            'Reservasi berhasil ditolak.'
        );
    }

    public function cancelReservation(Request $request, Reservation $reservation)
    {
        if ($reservation->status !== 'approved') {
            return back()->with(
                'error',
                'Hanya reservasi yang sudah disetujui yang dapat dibatalkan.'
            );
        }

        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $reservation->update([
            'status' => 'cancelled',
            'cancelled_by' => Auth::id(),
            'reason' => $request->reason,
        ]);

        return back()->with(
            'success',
            'Reservasi berhasil dibatalkan.'
        );
    }
}