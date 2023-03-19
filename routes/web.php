<?php

use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\Chat\ChatController;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');;

Route::get('/chat-dashboard', function () {
    $user = auth()->user();
    $onlineUser = $user->chatRequest()->where('from_id' , auth()->id())->get()->toArray();
//    dd($onlineUser , auth()->user());
        event(new  \App\Events\Demo());
        event(new  \App\Events\OnlineUser(auth()->user()));
    DB::statement("SET SESSION sql_mode=''");
   $messages  = \App\Models\Conversation::where(function ($q){
        $q->where('from_id',  auth()->id());
        $q->orWhere('to_id',  auth()->id());
    })->groupBy('from_id' , 'to_id')
       ->select('to_id' , 'from_id' , 'message', 'reply_to')
       ->orderBy('id', 'desc')
       ->get();

    $usedUserIds = [];
    foreach ($messages as $message) {
        $userId = $message->from_id == auth()->id() ? $message->to_id : $message->from_id;
        if (!in_array($userId, $usedUserIds)) {
            $recentUsersWithMessage[] = [
                'user_id' => $userId,
                'to_id' =>  $message->to_id,
                'message' => $message->message,
                'created_at' => $message->created_at,
                'reply_to' => $message->reply_to,
            ];
            $usedUserIds[] = $userId;
        }
    }
    if($messages->count() > 0){
        foreach ($recentUsersWithMessage as $key => $userMessage) {
            $recentUsersWithMessage[$key]['name'] = User::where('id', $userMessage['user_id'])->value('name') ?? '';
            $recentUsersWithMessage[$key]['photo_url'] = User::where('id', $userMessage['user_id'])->value('photo_url') ?? '';
        }
    }else{
        $recentUsersWithMessage = [];
    }
    return view('chat-user.dashboard' , compact('recentUsersWithMessage' ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     Route::prefix('chat')->group(function(){
         Route::get('/profile', [ChatController::class, 'profile'])->name('profile');
         Route::post('/profile-edit', [ChatController::class, 'updateProfile'])->name('edit.profile');
         Route::post('/change-password', [ChatController::class, 'changePassword'])->name('change.password');
         Route::post('/image-upload', [ChatController::class, 'imageUpload'])->name('image-upload');
         Route::get('/image', [ChatController::class, 'image'])->name('image');
         Route::get('/setting', [ChatController::class, 'setting'])->name('setting');
         Route::post('/photo-see', [ChatController::class, 'photoSee'])->name('setting');
         Route::post('/seen-show-hide', [ChatController::class, 'showHide'])->name('show.hide');
         Route::post('/subscribed', [ChatController::class, 'isSubscribed'])->name('subscribed');
         Route::post('/user-list', [ChatController::class, 'userList'])->name('user.list');
         Route::post('/add-friend', [ChatController::class, 'addFriend'])->name('add.friend');
         Route::post('/my-contact', [ChatController::class, 'myContact'])->name('my.contact');
         Route::post('/message-user-find', [ChatController::class, 'messageUserFriend'])->name('message.user.find');
         Route::post('/message-user-send', [ChatController::class, 'messageUserSend'])->name('message.user.send');
         Route::post('/file-upload', [ChatController::class, 'fileUpload'])->name('file-upload');
         Route::post('/another-user-profile', [ChatController::class, 'anotherUserProfile'])->name('another.user.profile');
         Route::post('/online-user', [ChatController::class, 'onlineUser'])->name('online.user');
         Route::post('/online-user-owner', [ChatController::class, 'onlineUserOwner'])->name('online.user.owner');
         Route::post('/user-search', [ChatController::class, 'userSearch'])->name('user.search');
         Route::post('/user-search-contact', [ChatController::class, 'userSearchContact'])->name('user.search.contact');
         Route::post('/user-search-contact-new', [ChatController::class, 'userSearchContactNew'])->name('user.search.contact.new');
         Route::post('/group-create', [ChatController::class, 'groupCreate'])->name('group.create');
     });


});

require __DIR__.'/auth.php';
