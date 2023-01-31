<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class CommunicationMessage extends Model
{
    use SoftDeletes;
    protected $table = 'communication_messages';
    protected $fillable = [
        'communication_id',
        'created_by',
        'message',
    ];

    protected $with = [
        'sender',
    ];

    public function communication(): BelongsTo
    {
        return $this->belongsTo(Communication::class, 'communication_id');
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
