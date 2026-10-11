<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        // Nilai jumlah rekapitulasi (langsung count)
        $pendingReportsCount = Report::where('status', 'pending')->count();

        $maintenanceFacilitiesCount = Facility::where(
            'status',
            'maintenance'
        )
            ->count();

        // output ke view
        return view(
            'petugas.dashboard',
            compact('pendingReservations',
                    'pendingReportsCount',
                    'maintenanceFacilitiesCount'            
            )
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

        return view('petugas.fasilitas', compact(
            'facilities',
            'reservations'
        ));
    }

    /**
     * Memulai perbaikan fasilitas.
     */
    public function mulaiPerbaikan(Facility $facility)
    {
        if ($facility->operational_status !== 'active') {
            return back()->with(
                'error',
                'Fasilitas tidak tersedia untuk memulai perbaikan.'
            );
        }
        
        $facility->update([
            'operational_status' => 'maintenance',
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
        if ($facility->operational_status !== 'maintenance') {
            return back()->with(
                'error',
                'Fasilitas tidak sedang dalam perbaikan.'
            );
        }

        $facility->update([
            'operational_status' => 'active',
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