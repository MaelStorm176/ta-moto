<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class MotorbikeCategory extends Model
{
    use HasFactory;

    protected $table = 'motorbike_categories';
    public function motorbikes(): HasMany
    {
        return $this->hasMany(Motorbike::class);
    }
}
