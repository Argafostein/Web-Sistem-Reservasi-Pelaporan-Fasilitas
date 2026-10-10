<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        if ($reservation->status !== 'pending') {
            return back()->with(
                'error',
                'Reservasi ini sudah diproses.'
            );
        }

        $overlappingReservation = Reservation::where(
                'facility_id',
                $reservation->facility_id
            )
            ->where('reservation_date', $reservation->reservation_date)
            ->where('status', 'approved')
            ->where('reservation_id', '!=', $reservation->reservation_id)
            ->where('start_time', '<', $reservation->end_time)
            ->where('end_time', '>', $reservation->start_time)
            ->first();

        if ($overlappingReservation) {
            return back()->with(
                'error',
                'Reservasi tidak dapat disetujui karena jadwal berbenturan dengan reservasi lain.'
            );
        }

        DB::transaction(function () use ($reservation) {
            $reservation->update([
                'status' => 'approved',
            ]);

            ReservationLog::create([
                'reservation_id' => $reservation->reservation_id,
                'user_id' => Auth::id(),
                'action' => 'approved',
                'reason' => null,
            ]);
        });

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

        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        DB::transaction(function () use ($reservation, $validated) {
            $reservation->update([
                'status' => 'rejected',
            ]);

            ReservationLog::create([
                'reservation_id' => $reservation->reservation_id,
                'user_id' => Auth::id(),
                'action' => 'rejected',
                'reason' => $validated['reason'],
            ]);
        });

        return back()->with(
            'success',
            'Reservasi berhasil ditolak.'
        );
    }

    public function cancelReservation(
        Request $request,
        Reservation $reservation
    ) {
        if ($reservation->status !== 'approved') {
            return back()->with(
                'error',
                'Hanya reservasi yang sudah disetujui yang dapat dibatalkan.'
            );
        }

        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        DB::transaction(function () use ($reservation, $validated) {
            $reservation->update([
                'status' => 'cancelled',
            ]);

            ReservationLog::create([
                'reservation_id' => $reservation->reservation_id,
                'user_id' => Auth::id(),
                'action' => 'cancelled',
                'reason' => $validated['reason'],
            ]);
        });

        return back()->with(
            'success',
            'Reservasi berhasil dibatalkan.'
        );
    }

    public function history()
    {
        $reservations = Reservation::with([
            'user',
            'facility',
            'logs.user',
        ])
            ->whereIn('status', [
                'approved',
                'rejected',
                'cancelled',
                'completed',
            ])
            ->latest('created_at')
            ->get()
            ->filter(function ($reservation) {
                $latestLog = $reservation->logs->first();

                return $latestLog
                    && in_array($latestLog->action, [
                        'approved',
                        'rejected',
                        'cancelled',
                    ])
                    && $latestLog->user
                    && $latestLog->user->role === 'petugas';
            })
            ->values();

        return view('petugas.riwayat', compact(
            'reservations'
        ));
    }

    public function queue()
    {
        $pendingReservations = Reservation::with([
            'user',
            'facility',
        ])
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('petugas.antrian', compact('pendingReservations'));
    }
}