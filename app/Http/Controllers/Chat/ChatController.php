<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\ChatRequest;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function profile(){
        return \view('chat-user.ajax.sidebar.profile');
    }
    public function image(){
        return \view('chat-user.ajax.component.image');
    }

    public function updateProfile( Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $userUpdate = \auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'about' => $request->bio,
            'address' => $request->address,
        ]);
        $user = auth()->user();
        return \view('chat-user.ajax.sidebar.setting' , compact('user'));
    }

    public function changePassword( Request $request){
        $request->validate([
            'old_password' => ['required'],
            'password' => ['required', 'integer','min:6', 'confirmed'],
        ]);
        if (Hash::check($request->old_password, auth()->user()->password)) {
            auth()->user()->fill([
                'password' => Hash::make($request->password)
            ])->save();
        }else{
            return  response()->json([
                'message' => "Password Not Match"
            ],404);
        }
        return true;

    }

    public function imageUpload( Request $request){
        if(isset($request->profile_image)){
            $data = $request->all();
            auth()->user()->fill([
                'photo_url' => uploadFile($data['profile_image'][0], "Profile"),
            ])->save();
            return true;
        }else{
            return  response()->json([
                'message' => "Image Must Be Required"
            ],404);
        }



    }

    public function setting(){
        return \view('chat-user.ajax.sidebar.setting');
    }

    public function photoSee(Request $request){
        \auth()->user()->update([
            'is_photo_see' => $request->value,
        ]);
        return  true;
    }
    public function showHide(Request $request){
        \auth()->user()->update([
            'is_seen_show' => $request->value,
        ]);
        return  true;
    }
    public function isSubscribed(Request $request){
        \auth()->user()->update([
            'is_subscribed' => $request->value,
        ]);
        return  true;
    }

    public function userList( Request $request){
        $chatRequestFrom = \App\Models\ChatRequest::where('from_id' , auth()->id())->pluck('owner_id')->toArray();
        $chatRequestOwner = \App\Models\ChatRequest::where('owner_id' , auth()->id())->pluck('from_id')->toArray();
        $chatRequestId = array_unique(array_merge($chatRequestFrom, $chatRequestOwner));
        $users = User::whereNotIn('id' , $chatRequestId)->orderBy('id' , 'desc')->get();

        return \view('chat-user.ajax.modal.user-list', compact('users'));
    }
    public function addFriend( Request $request){
        $data = $request->all();

        ChatRequest::create([
            'from_id'    => \auth()->id(),
            'owner_id'   => $data['ownerId'],
            'owner_type' => User::class,
            'status' => 1,
        ]);
        $user = User::find($data['ownerId'])->toArray();
        return response()->json([
            'message' => true,
            'user' => $user,
            'image' => setImage($user['photo_url']) ,
            'last_message' => lastMessage($user['id']) ,
            'last_date_message' => lastMessageDate($user['id']) ,
        ], 202);
    }

    public function myContact( Request $request){

        $chatRequestFrom = \App\Models\ChatRequest::where('from_id' , auth()->id())->pluck('owner_id')->toArray();
        $chatRequestOwner = \App\Models\ChatRequest::where('owner_id' , auth()->id())->pluck('from_id')->toArray();
        $chatRequestId = array_unique(array_merge($chatRequestFrom, $chatRequestOwner));
        $users = User::where('id' , '!=' , \auth()->id())->whereIn('id' , $chatRequestId)->orderBy('id' , 'desc')->get();

        return \view('chat-user.ajax.modal.my-contact', compact('users'));
    }

    public function messageUserFriend( Request $request){

        $user = User::find($request->id);
        $id = $request->id;
        $messages =  Conversation::with('sender', 'receiver')->where(function($q) use ($id) {
            $q->where('from_id', auth()->id());
            $q->where('to_id', $id);
        })->orWhere(function($q) use ($id) {
            $q->where('from_id', $id);
            $q->where('to_id', auth()->id());
        })->get();
        return \view('chat-user.chat.chat', compact('user' , 'messages' , 'id'));
    }

    public function messageUserSend( Request $request){
        $input = [
            'title' => $request->message,
        ];
        $conversation =  Conversation::create([
            'from_id' => $request->authId,
            'to_id' => $request->id,
            'message' => $request->message,
            'message_type' => 0,
            'status' => 1,
            'url_details' => json_encode($input),
        ]);


        $message = Conversation::with('sender' , 'receiver')->find($conversation->id);
        $data = [
            'to_id' => $message->to_id,
            'message' => true,
            'chat' => $message,
            'date' => messageDate($message->created_at),
            'sender_image' => setImage($message->sender->photo_url),
            'receiver_image' => setImage($message->receiver->photo_url),
            'own_user' => $message->sender,
            'own_user_re' => $message->receiver,
        ];
        broadcast(new \App\Events\MessageSend($data));
        return response()->json([
            'message' => true,
            'chat' => $message,
            'sender_image' => setImage($message->sender->photo_url),
            'receiver_image' => setImage($message->receiver->photo_url),
            'own_user' => \auth()->user(),
            'own_user_image' => setImage(\auth()->user()->photo_url),
            'date' => messageDate($message->created_at),
        ], 202);

    }

    public function fileUpload(Request $request){

        $input = [
            'title' => "file_upload",
        ];
        $conversation =  Conversation::create([
            'from_id' => $request->auth_id,
            'to_id' => $request->user_id,
            'message' => "file_upload",
            'message_type' => 1,
            'status' => 1,
            'url_details' => json_encode($input),
            'file_name' => uploadFile($request->fromFile , 'chat')
        ]);
        $message = Conversation::with('sender' , 'receiver')->find($conversation->id);
        $data = [
            'to_id' => $message->to_id,
            'message' => true,
            'chat' => $message,
            'image_message' => setImage($message->file_name),
            'image_type' => setImage($message->message_type),
            'date' => messageDate($message->created_at),
            'sender_image' => setImage($message->sender->photo_url),
            'receiver_image' => setImage($message->receiver->photo_url),
            'own_user' => $message->sender,
            'own_user_re' => $message->receiver,
        ];
        broadcast(new \App\Events\MessageSend($data));
        return response()->json([
            'message' => true,
            'chat' => $message,
            'image_message' => setImage($message->file_name),
            'sender_image' => setImage($message->sender->photo_url),
            'receiver_image' => setImage($message->receiver->photo_url),
            'own_user' => \auth()->user(),
            'own_user_image' => setImage(\auth()->user()->photo_url),
            'date' => messageDate($message->created_at),
        ], 202);
    }

    public function anotherUserProfile(Request $request){
        $userFind = User::find($request->id);
        $id = $request->id;
        $myMessage = \App\Models\Conversation:: where(function ($q) use ($id){
            $q->where('to_id', $id);
            $q->where('from_id', auth()->id());
        })->where('message_type', 1)->pluck('id')->toArray();
        $anotherMessage =  \App\Models\Conversation:: where(function ($q) use ($id){
            $q->where('to_id', auth()->id());
            $q->where('from_id', $id);
        })->where('message_type', 1)->pluck('id')->toArray();
        $uniqueIds  = array_unique(array_merge($myMessage , $anotherMessage));
        $imgaes = Conversation::whereIn('id' , $uniqueIds)->get();

        return \view('chat-user.ajax.sidebar.another-profile' , compact('userFind' , 'imgaes'));
    }

    public function onlineUser(Request $request){
        $chatRequestFrom = \App\Models\ChatRequest::where('from_id' , auth()->id())->pluck('owner_id')->toArray();
        $chatRequestOwner = \App\Models\ChatRequest::where('owner_id' , auth()->id())->pluck('from_id')->toArray();
        $chatRequestId = array_unique(array_merge($chatRequestFrom, $chatRequestOwner));
        $users = User::where('id' , '!=' , \auth()->id())->whereIn('id' , $chatRequestId)->orderBy('id' , 'desc')->pluck('id')->toArray();
        if(in_array($request->id , $users) == true){
            $user = User::where('id' ,  $request->id)->first();
            $data = [
                'name' => $user->name,
                'id' => $user->id,
                'photo_url' => setImage($user->photo_url)
            ];
            return  $data;
        }
    }
}