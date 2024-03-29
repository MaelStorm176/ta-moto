<?php

use App\Models\Communication;
use App\Models\ForumChannel;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', static function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('ForumChannel.{channel}', static function ($user, ForumChannel $channel) {
    if ($channel->users()->where('user_id', $user->id)->exists()) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar,
            'is_admin' => $user->role->id === 1,
        ];
    }
    return false;
});

Broadcast::channel('Communication.{communication}', static function ($user, Communication $communication) {
    if ($communication->sender()->id === $user->id || $communication->receiver()->id === $user->id) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar,
            'is_admin' => $user->role->id === 1,
        ];
    }
    return false;
});
