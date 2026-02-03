<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function checkStatus()
    {
        $adminOnline = User::where('role', 'admin')
            ->whereNotNull('last_seen_at')
            ->exists();

        return response()->json(['online' => $adminOnline]);
    }

    public function list(Request $request)
    {
        $user = Auth::user();

        $afterId = $request->query('after_id');

        $query = ChatMessage::where('user_id', $user->id);

        if ($afterId) {
            $query->where('id', '>', $afterId);
        }

        $messages = $query->orderBy('id')->get();

        $data = $messages->map(function (ChatMessage $message) {
            return [
                'id' => $message->id,
                'sender_type' => $message->sender_type,
                'content' => $message->content,
                'created_at' => $message->created_at ? $message->created_at->toDateTimeString() : null,
            ];
        });

        return response()->json(['messages' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $user = Auth::user();

        $message = ChatMessage::create([
            'user_id' => $user->id,
            'sender_type' => 'user',
            'content' => $request->input('content'),
        ]);

        return response()->json([
            'message' => [
                'id' => $message->id,
                'sender_type' => $message->sender_type,
                'content' => $message->content,
                'created_at' => $message->created_at ? $message->created_at->toDateTimeString() : null,
            ],
        ]);
    }
}
