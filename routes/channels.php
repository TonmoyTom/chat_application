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
Broadcast::channel('new-user', function ($user) {
    $data = [
        'name' => $user->name,
        'id' => $user->id,
        'photo_url' => setImage($user->photo_url)
    ];
   return $data;
});

//Broadcast::channel('online-user', function ($user) {
//    $chatRequestFrom = \App\Models\ChatRequest::where('from_id' ,$user->id)->pluck('owner_id')->toArray();
//    $chatRequestOwner = \App\Models\ChatRequest::where('owner_id' ,$user->id)->pluck('from_id')->toArray();
//    $chatRequestId = array_unique(array_merge($chatRequestFrom, $chatRequestOwner));
//    $users = \App\Models\User::whereIn('id' , $chatRequestId)->orderBy('id' , 'desc')->get();
////    $data = [
////        'name' => @$userAdd->name,
////        'id' => @$userAdd->id,
////        'photo_url' => setImage(@$userAdd->photo_url)
////    ];
////    $check = ($onlineUser != null) ? $data : false
//    return $users;
//});
