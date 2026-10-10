<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationLog extends Model
{
    protected $table = 'reservation_logs';

    protected $primaryKey = 'log_id';

    protected $fillable = [
        'reservation_id',
        'user_id',
        'action',
        'reason',
    ];

    public function reservation()
    {
        return $this->belongsTo(
            Reservation::class,
            'reservation_id',
            'reservation_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id_user'
        );
    }
}