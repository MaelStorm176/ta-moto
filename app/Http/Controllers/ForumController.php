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
}
