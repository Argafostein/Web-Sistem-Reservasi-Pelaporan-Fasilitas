<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
        'code',
        'name',
        'type',
        'location',
        'room',
        'capacity',
        'pic',
        'banner_class',
        'description',
        'equipment',
    ];

    protected $casts = [
        'equipment' => 'array',
        'capacity' => 'integer',
    ];

    public function slots()
    {
        return $this->hasMany(FacilitySlot::class)->orderBy('sort_order');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Bentuk array yang sama persis dengan objek fasilitas di public/script.js,
     * supaya frontend existing bisa langsung memakainya tanpa perubahan struktur.
     */
    public function toFrontend(): array
    {
        return [
            'id' => $this->code,
            'name' => $this->name,
            'type' => $this->type,
            'location' => $this->location,
            'room' => $this->room,
            'capacity' => $this->capacity,
            'bannerClass' => $this->banner_class,
            'pic' => $this->pic,
            'equipment' => $this->equipment ?? [],
            'description' => $this->description,
            'slots' => $this->slots
                ->map(fn (FacilitySlot $slot) => $slot->toFrontend())
                ->values()
                ->all(),
        ];
    }
}
