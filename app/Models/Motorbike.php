<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Motorbike extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(MotorbikeCategory::class, 'category');
    }
}
