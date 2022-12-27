<?php

namespace App\Http\Controllers;

use App\Models\ForumChannel;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $forums = ForumChannel::all();
        return view('forum.index', compact('forums'));
    }

    public function showChannel(ForumChannel $channel)
    {
        return view('forum.showChannel', compact('channel'));
    }
}
