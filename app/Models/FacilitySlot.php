<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilitySlot extends Model
{
    protected $fillable = [
        'facility_id',
        'slot_code',
        'time',
        'status',
        'booked_by',
        'sort_order',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    /**
     * Bentuk array yang sama persis dengan objek slot di public/script.js.
     */
    public function toFrontend(): array
    {
        return [
            'id' => $this->slot_code,
            'time' => $this->time,
            'status' => $this->status,
            'bookedBy' => $this->booked_by,
        ];
    }
}
