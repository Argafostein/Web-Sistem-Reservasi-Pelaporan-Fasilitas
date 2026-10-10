<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function dashboard()
    {
        $pendingReservations = Reservation::where(
            'status',
            'pending'
        )
            ->with(['user', 'facility'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view(
            'petugas.dashboard',
            compact('pendingReservations')
        );
    }

    /**
     * Menampilkan daftar fasilitas.
     */
    public function fasilitas()
    {
        // Ambil semua fasilitas
        $facilities = Facility::orderBy('name', 'asc')->get();

        // Ambil data reservasi yang memengaruhi ketersediaan
        $reservations = Reservation::whereIn('status', [
            'pending',
            'approved',
        ])->get([
            'facility_id',
            'reservation_date',
            'start_time',
            'end_time',
            'status',
        ]);

        return view('Petugas.fasilitas', compact(
            'facilities',
            'reservations'
        ));
    }

    /**
     * Memulai perbaikan fasilitas.
     */
    public function mulaiPerbaikan(Facility $facility)
    {
        if ($facility->status !== 'available') {
            return back()->with(
                'error',
                'Fasilitas tidak tersedia untuk memulai perbaikan.'
            );
        }

        $facility->update([
            'status' => 'maintenance',
        ]);

        return back()->with(
            'success',
            'Fasilitas berhasil diubah menjadi Dalam Perbaikan.'
        );
    }

    /**
     * Menyelesaikan perbaikan fasilitas.
     */
    public function selesaikanPerbaikan(Facility $facility)
    {
        if ($facility->status !== 'maintenance') {
            return back()->with(
                'error',
                'Fasilitas tidak sedang dalam perbaikan.'
            );
        }

        $facility->update([
            'status' => 'available',
        ]);

        return back()->with(
            'success',
            'Perbaikan selesai. Fasilitas sekarang aktif kembali.'
        );
    }

    public function ubahStatusFasilitas(Facility $facility)
    {
        if ($facility->status === 'available') {
            $facility->update([
                'status' => 'unavailable',
            ]);

            return redirect()->back()->with(
                'success',
                'Fasilitas berhasil diubah menjadi dalam perbaikan.'
            );
        }

        if ($facility->status === 'unavailable') {
            $facility->update([
                'status' => 'available',
            ]);

            return redirect()->back()->with(
                'success',
                'Perbaikan selesai. Fasilitas sekarang aktif.'
            );
        }

        return redirect()->back()->with(
            'error',
            'Status fasilitas tidak dikenali.'
        );
    }
}