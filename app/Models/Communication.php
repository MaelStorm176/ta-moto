<?php

namespace App\Models;

use App\Traits\FormattedTimestampsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Communication extends Model
{
    use FormattedTimestampsTrait;

    protected $table = 'communications';
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'accepted',
    ];

    protected $casts = [
        'accepted' => 'boolean',
    ];

    protected $with = [
        'sender',
        'receiver',
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(CommunicationMessage::class);
    }
}
