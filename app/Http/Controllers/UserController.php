<?php

namespace App\Http\Controllers;

use App\Events\ExampleEvent;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;



class UserController extends Controller
{
    public function showCorrectHomepage()
    {
        /** @var \App\Models\User $user - This is a intelephense extension issue */
        $user = auth()->user();

        if (auth()->check()) {
            return view('homepage-feed', [
                'posts' => $user->feedPosts()->latest()->paginate(5)
            ]);
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
            event(new ExampleEvent([
                'username' => auth()->user()->username,
                'action' => 'logged in'
            ]));
            return redirect('/')->with('success', 'You have successfully logged in!');
        } else {
            return redirect('/')->with('failure', 'Invalid login credentials!');
        }
    }

    public function logout()
    {
        event(new ExampleEvent([
            'username' => auth()->user()->username,
            'action' => 'logged out'
        ]));
        auth()->logout();
        return redirect('/')->with('success', 'You are now logged out!');
    }

    private function getSharedData($user)
    {
        $isFollowing = 0;

        if (auth()->check()) {
            $isFollowing = Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->count();
        }

        View::share('sharedData', [
            'isFollowing' => $isFollowing,
            'avatar' => $user->avatar,
            'username' => $user->username,
            'postCount' => $user->posts()->count(),
            'followerCount' => $user->followers()->count(),
            'followingCount' => $user->followingUsers()->count(),
            'isAdmin' => $user->isAdmin
        ]);
    }

    public function profile(User $user)
    {
        $this->getSharedData($user);

        return view('profile-posts', [
            'posts' => $user->posts()->latest()->get(),
        ]);
    }

    public function profileRaw(User $user)
    {
        return response()->json([
            'html' => view('profile-posts-only', [
                'posts' => $user->posts()->latest()->get()
            ])->render(),
            'docTitle' => $user->username . "'s Profile"
        ]);
    }

    public function profileFollowers(User $user)
    {
        $this->getSharedData($user);

        return view('profile-followers', [
            'followers' => $user->followers()->latest()->get(),
        ]);
    }

    public function profileFollowersRaw(User $user)
    {
        return response()->json([
            'html' => view('profile-followers-only', [
                'followers' => $user->followers()->latest()->get()
            ])->render(),
            'docTitle' => $user->username . "'s Followers"
        ]);
    }

    public function profileFollowing(User $user)
    {
        $this->getSharedData($user);

        return view('profile-following', [
            'following' => $user->followingUsers()->latest()->get(),
        ]);
    }

    public function profileFollowingRaw(User $user)
    {
        return response()->json([
            'html' => view('profile-following-only', [
                'following' => $user->followingUsers()->latest()->get()
            ])->render(),
            'docTitle' => 'Who ' . $user->username . ' follows'
        ]);
    }

    public function showAvatarForm(User $user)
    {
        $user = auth()->user();

        return view('avatar-form', [
            'avatar' => $user->avatar,
            'username' => $user->username
        ]);
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
