<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use App\Models\ReservationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function create()
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

        return view('reservasi', compact(
            'facilities',
            'reservations'
        ));
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

    public function history()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with(['facility','logs.user'])
            ->latest()
            ->get();

        return view('riwayat-reservasi', compact('reservations'));
    }

    public function cancel($id)
    {
        $reservation = Reservation::where(
            'reservation_id',
            $id
        )
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Periksa batas waktu pembatalan: 1 jam sejak dibuat.
        $deadline = $reservation->created_at->copy()->addHour();

        if (now()->greaterThan($deadline)) {
            return back()->with(
                'error',
                'Reservasi hanya dapat dibatalkan dalam 1 jam setelah pengajuan.'
            );
        }

        // Pastikan reservasi belum berada pada status akhir.
        if (in_array($reservation->status, [
            'completed',
            'rejected',
            'cancelled',
        ])) {
            return back()->with(
                'error',
                'Reservasi ini tidak dapat dibatalkan.'
            );
        }

        DB::transaction(function () use ($reservation) {
            $reservation->update([
                'status' => 'cancelled',
            ]);

            ReservationLog::create([
                'reservation_id' => $reservation->reservation_id,
                'user_id' => Auth::id(),
                'action' => 'cancelled',
                'reason' => null,
            ]);
        });

        return back()->with(
            'success',
            'Reservasi berhasil dibatalkan.'
        );
    }
}