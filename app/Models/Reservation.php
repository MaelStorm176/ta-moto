<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Reservation extends Model
{
    protected $table = 'reservations';
    protected $fillable = [
        'date',
        'type',
        'reserved_by',
    ];
}
