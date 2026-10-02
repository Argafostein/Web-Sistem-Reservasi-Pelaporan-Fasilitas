<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'code',
        'facility_id',
        'facility_name',
        'facility_type',
        'location',
        'date_label',
        'slot_time',
        'purpose',
        'applicant',
        'affiliation',
        'status',
        'applied_at_label',
        'approved_by',
        'notes',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    /**
     * Bentuk array yang sama persis dengan objek reservasi di public/script.js
     * (INITIAL_RESERVATIONS / riwayat), supaya render riwayat & detail tetap jalan.
     */
    public function toFrontend(): array
    {
        return [
            'id' => $this->code,
            'facilityId' => $this->facility?->code ?? '',
            'facilityName' => $this->facility_name,
            'facilityType' => $this->facility_type,
            'location' => $this->location,
            'date' => $this->date_label,
            'slotTime' => $this->slot_time,
            'purpose' => $this->purpose,
            'applicant' => $this->applicant,
            'affiliation' => $this->affiliation,
            'status' => $this->status,
            'appliedAt' => $this->applied_at_label,
            'approvedBy' => $this->approved_by,
            'notes' => $this->notes,
        ];
    }
}
