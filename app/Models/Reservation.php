<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'facility_id');
    }
}