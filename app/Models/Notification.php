<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Symfony\Component\HttpFoundation\StreamedResponse;


class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = [
        'title',
        'content',
    ];

    public function readers(): HasMany
    {
        return $this->hasMany(NotificationRead::class);
    }
}
