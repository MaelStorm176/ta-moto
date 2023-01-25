<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ForumChannel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $forums = ForumChannel::query()
            ->whereHas('users', static function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->where('deleted_at', null)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('auth.profile', compact('forums'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $avatarName = auth()->user()->avatar;
        if ($request->hasFile('avatar')) {
            $avatarName = auth()->user()->id . '_avatar' . time() . '.' . $request->avatar->extension();
            $request->avatar->move(storage_path('app/public/users'), $avatarName);
            $avatarName = 'users/' . $avatarName;
        }

        $request->user()->update([
            'avatar' => $avatarName,
            'name' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => $request->get('password') ? bcrypt($request->get('password')) : $request->user()->password,
        ]);

        return to_route('profile');
    }
}
