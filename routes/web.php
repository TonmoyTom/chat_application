<?php

use App\Http\Controllers\ProfileController;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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
     $chatRequestFrom = Conversation::with('sender' , 'receiver')
         ->where('from_id' , auth()->id())
         ->pluck('to_id')->toArray();
        $chatRequestOwner = Conversation::with('sender' , 'receiver')
            ->where('to_id' , auth()->id())
            ->pluck('from_id')->toArray();
    $chatRequestId = array_unique(array_merge($chatRequestFrom, $chatRequestOwner));
    $users = User::whereIn('id' , $chatRequestId)->orderBy('id' , 'desc')->get();
    $firstUser = User::whereIn('id' , $chatRequestId)->orderBy('id' , 'desc')->first();
    return view('dashboard' , compact('users' , 'firstUser'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile-edit', [ProfileController::class, 'updateProfile'])->name('edit.profile');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
    Route::post('/image-upload', [ProfileController::class, 'imageUpload'])->name('image-upload');
    Route::get('/image', [ProfileController::class, 'image'])->name('image');
    Route::get('/setting', [ProfileController::class, 'setting'])->name('setting');
    Route::post('/photo-see', [ProfileController::class, 'photoSee'])->name('setting');
    Route::post('/seen-show-hide', [ProfileController::class, 'showHide'])->name('show.hide');
    Route::post('/subscribed', [ProfileController::class, 'isSubscribed'])->name('subscribed');
    Route::post('/user-list', [ProfileController::class, 'userList'])->name('user.list');
    Route::post('/add-friend', [ProfileController::class, 'addFriend'])->name('add.friend');
    Route::post('/my-contact', [ProfileController::class, 'myContact'])->name('my.contact');
    Route::post('/message-user-find', [ProfileController::class, 'messageUserFriend'])->name('message.user.find');
    Route::post('/message-user-send', [ProfileController::class, 'messageUserSend'])->name('message.user.send');

});

require __DIR__.'/auth.php';
