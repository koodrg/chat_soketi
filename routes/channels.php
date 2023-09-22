<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\ChatRoom;
use App\Constant\Role;

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

Broadcast::channel('room.{id}', function ($user, $id) {
    $chatRoom = ChatRoom::find($id);

    $isGuide = $user->id == $chatRoom->guide_id && $user->role == Role::GUIDE;
    $isAdmin = $user->role == Role::ADMIN;
    $isGuest = $user->id == $chatRoom->guest_id && $user->role = Role::GUEST;

    if($isGuide || $isAdmin || $isGuest)
    {
        return $user->only('id', 'name');
    }
});
