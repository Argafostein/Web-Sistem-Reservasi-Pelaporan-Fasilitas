<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'user_id',
        'facility_id',
        'reservation_date',
        'start_time',
        'end_time',
        'purpose',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'facility_id');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(
            ReservationLog::class,
            'reservation_id',
            'reservation_id'
        )->orderBy('created_at', 'desc');;
    }
}