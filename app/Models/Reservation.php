<?php

namespace App\Models;

use App\Traits\FormattedTimestampsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Reservation extends Model
{
    protected $table = 'reservations';
    protected $fillable = [
        'date',
        'type',
        'reserved_by',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reserved_by');
    }
}
