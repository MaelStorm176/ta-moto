<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class NotificationRead extends Model
{
    protected $table = 'notification_reads';
    protected $fillable = [
        'notification_id',
        'user_id',
        'read_at',
    ];
    public $timestamps = false;

    public function notification(): BelongsTo
    {
        return $this->belongsTo(Notification::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
