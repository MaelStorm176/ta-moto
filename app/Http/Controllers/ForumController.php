<?php

namespace App\Http\Controllers;

use App\Events\ForumChannelMessagePosted;
use App\Models\ForumChannel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $joined = $request->get('joined');
        $forums = ForumChannel::query()
            ->when($search, static function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->when($joined, static function ($query) {
                $query->whereHas('users', static function ($query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('forum.index', compact('forums'));
    }

    public function showChannel(ForumChannel $channel)
    {
        $max_users = $channel->max_users;
        $users = $channel->users()->count();
        $isFull = $max_users <= $users;
        $isJoined = $channel->users()->where('user_id', auth()->id())->exists();
        if ($isFull && !$isJoined) {
            return redirect()->route('forum.index')->with('error', 'Channel is full');
        }
        if (!$isJoined) {
            $channel->users()->create(['user_id' => auth()->id()]);
        }
        return view('forum.showChannel', compact('channel'));
    }

    public function addMessage(Request $request, ForumChannel $channel): RedirectResponse|JsonResponse
    {
        $request->validate([
            'message' => 'required|string|min:3|max:1000',
        ]);
        $message = $channel->messages()->create([
            'user_id' => auth()->id(),
            'message' => $request->get('message')
        ]);
        broadcast(new ForumChannelMessagePosted($message));

        //test if ajax request
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Message posted successfully',
                'data' => $message
            ]);
        }
        return back();
    }

    public function quitChannel(ForumChannel $channel): RedirectResponse
    {
        $channel->users()->where('user_id', auth()->id())->delete();
        return redirect()->route('forum.index')->with('success', 'Vous avez bien quitté le channel');
    }
}
