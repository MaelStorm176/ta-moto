<?php

namespace App\Http\Controllers;

use App\Events\ForumChannelMessagePosted;
use App\Models\ForumChannel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $forums = $request->whenFilled('search', function ($search) {
            return ForumChannel::where('title', 'like', "%{$search}%")->orderBy('created_at', 'desc')->paginate(10);
        }, function () {
            return ForumChannel::orderBy('created_at', 'desc')->paginate(10);
        });
        return view('forum.index', compact('forums'));
    }

    public function showChannel(ForumChannel $channel)
    {
        return view('forum.showChannel', compact('channel'));
    }

    public function addMessage(Request $request, ForumChannel $channel): RedirectResponse
    {
        $message = $channel->messages()->create([
            'user_id' => auth()->id(),
            'message' => $request->message
        ]);

        broadcast(new ForumChannelMessagePosted($message))->toOthers();

        return back();
    }
}
