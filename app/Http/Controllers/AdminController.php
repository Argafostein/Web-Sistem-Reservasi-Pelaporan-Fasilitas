<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Report;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function users()
    {
        return view('Admin.users', [
            'users' => User::query()->latest()->paginate(15),
            'pendingUsers' => User::where('account_status', 'pending')
                ->latest()
                ->get(),
        ]);
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['user', 'petugas'])],
        ]);

        User::create([
            ...$validated,
            'account_status' => 'active',
            'verified_at' => now(),
            'verified_by' => Auth::id(),
        ]);

        return back()->with('success', 'Akun berhasil didaftarkan dan langsung aktif.');
    }

    public function verifyUser(User $user)
    {
        $user->update([
            'account_status' => 'active',
            'verified_at' => now(),
            'verified_by' => Auth::id(),
        ]);

        return back()->with('success', 'Akun pengguna berhasil diverifikasi.');
    }

    public function rejectUser(User $user)
    {
        if ($user->id_user === Auth::id()) {
            abort(422, 'Admin yang sedang login tidak dapat ditolak.');
        }

        $user->update([
            'account_status' => 'rejected',
            'verified_at' => null,
            'verified_by' => Auth::id(),
        ]);

        return back()->with('success', 'Akun pengguna berhasil ditolak.');
    }

    public function facilities()
    {
        return view('Admin.facilities', [
            'facilities' => Facility::orderBy('name')->paginate(15),
        ]);
    }

    public function storeFacility(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'capacity' => ['nullable', 'integer', 'min:1'],
        ]);

        Facility::create($validated);

        return back()->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function updateFacility(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'status' => ['required', Rule::in(['available', 'unavailable'])],
        ]);

        $facility->update($validated);

        return back()->with('success', 'Detail fasilitas berhasil diperbarui.');
    }

    public function deactivateFacility(Facility $facility)
    {
        $facility->update(['status' => 'unavailable']);

        return back()->with('success', 'Fasilitas berhasil dinonaktifkan.');
    }

    public function reports(Request $request)
    {
        $facilities = Facility::orderBy('name')->get();
        $facilityId = $request->integer('facility_id');

        $occupancy = Reservation::query()
            ->selectRaw('facility_id, COUNT(*) as reservation_count')
            ->whereIn('status', ['pending', 'approved'])
            ->when($facilityId, fn ($query) => $query->where('facility_id', $facilityId))
            ->groupBy('facility_id')
            ->with('facility')
            ->get();

        $damage = Report::query()
            ->selectRaw('facility_id, COUNT(*) as damage_count')
            ->when($facilityId, fn ($query) => $query->where('facility_id', $facilityId))
            ->groupBy('facility_id')
            ->with('facility')
            ->get();

        return view('Admin.reports', compact(
            'facilities',
            'occupancy',
            'damage',
            'facilityId'
        ));
    }

    public function exportReports(Request $request)
    {
        $facilityId = $request->integer('facility_id');
        $rows = Facility::query()
            ->when($facilityId, fn ($query) => $query->whereKey($facilityId))
            ->orderBy('name')
            ->get()
            ->map(function (Facility $facility) {
                return [
                    $facility->name,
                    $facility->location,
                    Reservation::where('facility_id', $facility->facility_id)
                        ->whereIn('status', ['pending', 'approved'])
                        ->count(),
                    Report::where('facility_id', $facility->facility_id)->count(),
                ];
            });

        $csv = fopen('php://temp', 'w+');
        fputcsv($csv, ['Fasilitas', 'Lokasi', 'Jumlah Reservasi', 'Frekuensi Kerusakan']);

        foreach ($rows as $row) {
            fputcsv($csv, $row);
        }

        rewind($csv);
        $content = stream_get_contents($csv);
        fclose($csv);

        return Response::make($content, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="rekap-fasilitas.csv"',
        ]);
    }
}
