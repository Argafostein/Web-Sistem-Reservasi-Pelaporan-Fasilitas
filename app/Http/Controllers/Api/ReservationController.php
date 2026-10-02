<?php

namespace App\Http\Controllers\Api;

use App\Models\Facility;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController
{
    public function index()
    {
        $reservations = Reservation::with('facility')->orderByDesc('code')->get();

        return response()->json(
            $reservations->map(fn (Reservation $reservation) => $reservation->toFrontend())->values()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'string', 'max:50'],
            'facilityId' => ['required', 'string', 'exists:facilities,code'],
            'slotTime' => ['required', 'string', 'max:30'],
            'purpose' => ['required', 'string'],
            'applicant' => ['required', 'string', 'max:255'],
            'affiliation' => ['required', 'string', 'max:255'],
        ]);

        if (Reservation::where('code', $validated['id'])->exists()) {
            return response()->json(['message' => 'Kode reservasi sudah terdaftar.'], 409);
        }

        $facility = Facility::where('code', $validated['facilityId'])->firstOrFail();

        $reservation = Reservation::create([
            'code' => $validated['id'],
            'facility_id' => $facility->id,
            'facility_name' => $facility->name,
            'facility_type' => $facility->type,
            'location' => "{$facility->location} ({$facility->room})",
            'date_label' => $request->input('date', 'Kamis, 01 Okt 2026'),
            'slot_time' => $validated['slotTime'],
            'purpose' => $validated['purpose'],
            'applicant' => $validated['applicant'],
            'affiliation' => $validated['affiliation'],
            'status' => 'Disetujui',
            'applied_at_label' => 'Baru saja',
            'approved_by' => $facility->pic,
            'notes' => $request->input('notes'),
        ]);

        $facility->slots()
            ->where('time', $validated['slotTime'])
            ->update([
                'status' => 'booked',
                'booked_by' => "{$validated['purpose']} ({$validated['applicant']})",
            ]);

        return response()->json($reservation->toFrontend(), 201);
    }

    public function cancel(string $code)
    {
        $reservation = Reservation::with('facility')->where('code', $code)->firstOrFail();

        $reservation->update(['status' => 'Dibatalkan']);

        if ($reservation->facility) {
            $reservation->facility->slots()
                ->where('time', $reservation->slot_time)
                ->update(['status' => 'available', 'booked_by' => null]);
        }

        return response()->json($reservation->toFrontend());
    }
}
