<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ForumChannelUser extends Model
{
    protected $table = 'forum_channel_users';
    protected $fillable = ['user_id', 'channel_id'];
    public $timestamps = false;

    public function channel(): BelongsTo
    {
        return $this->belongsTo(ForumChannel::class, 'channel_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
