<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class MotorbikeCategory extends Model
{
    public function motorbikes(): HasMany
    {
        return $this->hasMany(Motorbike::class, 'category');
    }
}
