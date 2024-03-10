<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;



class UserController extends Controller
{
    public function showCorrectHomepage()
    {
        if (auth()->check()) {
            return view('homepage-feed');
        } else {
            return view('homepage');
        }
    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect('/')->with('success', 'Account created successfully!');
    }

    public function login(Request $request, User $user)
    {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt([
            'username' => $incomingFields['loginusername'],
            'password' => $incomingFields['loginpassword']
        ])) {
            $request->session()->regenerate();
            return redirect('/profile/' . auth()->user()->username)->with('success', 'You have successfully logged in!');
        } else {
            return redirect('/')->with('failure', 'Invalid login credentials!');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You are now logged out!');
    }

    public function profile(User $user)
    {
        return view('profile-posts', [
            'avatar' => $user->avatar,
            'username' => $user->username,
            'posts' => $user->posts()->latest()->get(),
            'postCount' => $user->posts()->count(),
            'isAdmin' => $user->isAdmin
        ]);
    }

    public function showAvatarForm()
    {
        return view('avatar-form');
    }


    public function storeAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2000',

        ]);

        $user = auth()->user();

        $filename = $user->id . '-' . uniqid() . '.jpg';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('avatar'));

        $imgData = $image->cover(120, 120)->toJpeg();
        Storage::put('public/avatars/' . $filename, $imgData);

        $oldAvatar = $user->avatar;

        /** @var \App\Models\User $user **/
        $user->avatar = $filename;
        $user->save();

        if ($oldAvatar != '/fallback-avatar.jpg') {
            Storage::delete(str_replace('/storage/', 'public/', $oldAvatar));
        }

        return back()->with('success', 'Avatar uploaded successfully!');
    }
}
