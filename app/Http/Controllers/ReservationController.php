<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
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

    public function history()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('facility')
            ->latest()
            ->get();

        return view('riwayat-reservasi', compact('reservations'));
    }

    public function cancel($id)
    {
        // Cari reservasi
        $reservation = Reservation::findOrFail($id);

        // Pastikan reservasi memang milik user yang sedang login
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        // Deadline = 1 jam setelah reservasi dibuat
        $deadline = $reservation->created_at->copy()->addHour();

        // Cek apakah sudah melewati deadline
        if (now()->greaterThan($deadline)) {
            return back()->with(
                'error',
                'Reservasi tidak dapat dibatalkan karena sudah melewati batas waktu 1 jam.'
            );
        }

        // Reservasi yang sudah selesai/ditolak/dibatalkan tidak bisa dibatalkan lagi
        if (in_array($reservation->status, [
            'completed',
            'rejected',
            'cancelled'
        ])) {
            return back()->with(
                'error',
                'Reservasi ini tidak dapat dibatalkan.'
            );
        }

        // Ubah status menjadi cancelled
        $reservation->status = 'cancelled';
        $reservation->save();

        return back()->with(
            'success',
            'Reservasi berhasil dibatalkan.'
        );
    }
}