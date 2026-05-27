<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $initialMessage = $request->query('product') ? "Halo Admin, saya ingin bertanya tentang produk " . $request->query('product') : "";
        return view('chat', compact('initialMessage'));
    }

    public function fetch()
    {
        $messages = Message::where('user_id', auth()->id())->orderBy('created_at', 'asc')->get();
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        
        $message = Message::create([
            'user_id' => auth()->id(),
            'sender_type' => 'user',
            'message' => $request->message
        ]);

        return response()->json($message);
    }
}
