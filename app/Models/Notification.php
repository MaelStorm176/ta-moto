<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\StreamedResponse;


class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = [
        'title',
        'content',
    ];
}
