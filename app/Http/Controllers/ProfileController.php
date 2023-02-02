<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function profile(){
        return \view('ajax.sidebar.profile');
    }
    public function image(){
        return \view('ajax.component.image');
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
        return \view('ajax.sidebar.setting' , compact('user'));
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
        return \view('ajax.sidebar.setting');
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


}
