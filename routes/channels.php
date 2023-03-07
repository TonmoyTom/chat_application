<?php

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('private.{id}', function ($user, $id) {
    return (int)  $user->id === (int) $id ;

});

Broadcast::channel('chat', function ($user) {
    $data = [
        'name' => $user->name,
        'id' => $user->id,
        'photo_url' => setImage($user->photo_url)
    ];
   return $data;
});
