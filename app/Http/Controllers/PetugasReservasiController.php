<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationLog;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PetugasReservasiController extends Controller
{
    public function antrianReservasi()
    {
        $pendingReservations = Reservation::with([
            'user',
            'facility',
        ])
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->get();

        return view(
            'petugas.antrian-reservasi',
            compact('pendingReservations')
        );
    }


    public function approveReservation(Reservation $reservation)
    {
        $result = DB::transaction(function () use ($reservation) {

            $facility = Facility::where(
                'facility_id',
                $reservation->facility_id
            )
                ->lockForUpdate() // Mengunci fasilitas terlebih dahulu, semua proses persetujuan harus memakai urutan yang sama.
                ->firstOrFail();

            $currentReservation = Reservation::where(
                'reservation_id',
                $reservation->reservation_id
            )
                ->lockForUpdate() // Baca ulang reservasi dan kunci barisnya.
                ->firstOrFail();

            if ($currentReservation->status !== 'pending') { // Pastikan reservasi belum diproses
                return 'already_processed';
            }
            if ($facility->status !== 'available') { // Pastikan fasilitas dapat digunakan
                return 'facility_unavailable';
            }

            $overlappingReservation = Reservation::where(
                    'facility_id',
                    $currentReservation->facility_id
                )
                // Periksa konflik setelah kunci fasilitas diperoleh
                ->where(
                    'reservation_date',
                    $currentReservation->reservation_date
                )
                ->where('status', 'approved')
                ->where(
                    'reservation_id',
                    '!=',
                    $currentReservation->reservation_id
                )
                ->where(
                    'start_time',
                    '<',
                    $currentReservation->end_time
                )
                ->where(
                    'end_time',
                    '>',
                    $currentReservation->start_time
                )
                ->exists();

            if ($overlappingReservation) {
                return 'overlap';
            }

            $currentReservation->update([
                'status' => 'approved',
            ]);

            ReservationLog::create([
                'reservation_id' => $currentReservation->reservation_id,
                'user_id' => Auth::id(),
                'action' => 'approved',
                'reason' => null,
            ]);

            return 'approved';
        });

        if ($result === 'overlap') {
            return back()->with(
                'error',
                'Reservasi tidak dapat disetujui karena jadwal berbenturan dengan reservasi lain.'
            );
        }

        if ($result === 'facility_unavailable') {
            return back()->with(
                'error',
                'Reservasi tidak dapat disetujui karena fasilitas tidak tersedia.'
            );
        }

        if ($result === 'already_processed') {
            return back()->with(
                'error',
                'Reservasi ini sudah diproses.'
            );
        }

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
        $reservation
    ) {
        $validated = $request->validate([
            'reason' => ['required', 'string', 'max:500'],
        ], [
            'reason.required' => 'Alasan pembatalan wajib diisi.',
            'reason.max' => 'Alasan pembatalan maksimal 500 karakter.',
        ]);

        DB::transaction(function () use ($reservation, $validated) {
            $reservation = Reservation::where(
                'reservation_id',
                $reservation
            )
                ->lockForUpdate()
                ->firstOrFail();

            if ($reservation->status !== 'approved') {
                throw ValidationException::withMessages([
                    'reservation' => 'Hanya reservasi yang sudah disetujui yang dapat dibatalkan oleh petugas.',
                ]);
            }

            $reservation->update([
                'status' => 'cancelled',
            ]);

            ReservationLog::create([
                'reservation_id' => $reservation->reservation_id,
                'user_id' => Auth::id(),
                'action' => 'cancelled',
                'reason' => trim($validated['reason']),
            ]);
        });

        return redirect()
            ->route('petugas.riwayat.reservasi')
            ->with(
                'success',
                'Reservasi berhasil dibatalkan. Alasan darurat telah dicatat.'
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
            ->whereHas('logs.user', function ($query) {
                $query->where('role', 'petugas');
            })
            ->orderByDesc('created_at')
            ->get();

        return view('petugas.riwayat-reservasi', compact('reservations'));
    }
}
