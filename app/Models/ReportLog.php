<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReportLog extends Model
{
    protected $table = 'report_logs';

    protected $primaryKey = 'report_log_id';

    protected $fillable = [
        'report_id',
        'user_id',
        'action',
        'old_status',
        'new_status',
        'note',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(
            Report::class,
            'report_id',
            'report_id'
        );
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id_user'
        );
    }

    
    public function logs(): HasMany
    {
        return $this->hasMany(
            ReportLog::class,
            'report_id',
            'report_id'
        )->orderBy('created_at', 'desc');
    }

}
