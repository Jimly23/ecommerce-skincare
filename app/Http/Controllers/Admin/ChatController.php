<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::whereHas('messages')->with(['messages' => function($q) {
            $q->latest();
        }])->get()->sortByDesc(function($user) {
            return $user->messages->first()->created_at;
        });

        return view('admin.chat.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.chat.show', compact('user'));
    }

    public function fetch(User $user)
    {
        $messages = Message::where('user_id', $user->id)->orderBy('created_at', 'asc')->get();
        
        // Mark as read
        Message::where('user_id', $user->id)->where('sender_type', 'user')->where('is_read', false)->update(['is_read' => true]);

        return response()->json($messages);
    }

    public function store(Request $request, User $user)
    {
        $request->validate(['message' => 'required|string']);
        
        $message = Message::create([
            'user_id' => $user->id,
            'sender_type' => 'admin',
            'message' => $request->message,
            'is_read' => true
        ]);

        return response()->json($message);
    }
}
