<?php

namespace App\Http\Controllers;

use App\Models\ForumChannel;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $forums = ForumChannel::paginate(10);
        return view('forum.index', compact('forums'));
    }

    public function showChannel(ForumChannel $channel)
    {
        return view('forum.showChannel', compact('channel'));
    }

    public function addMessage(Request $request, ForumChannel $channel)
    {
        $channel->messages()->create([
            'user_id' => auth()->id(),
            'message' => $request->message
        ]);

        $broadcast = broadcast(new MessagePosted($channel, $message))->toOthers();

        return back();
    }
}
