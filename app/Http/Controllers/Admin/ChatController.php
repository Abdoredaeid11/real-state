<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($locale, Request $request)
    {
        $userIds = ChatMessage::select('user_id')->distinct()->pluck('user_id');
        $users = User::whereIn('id', $userIds)->orderBy('name')->get();

        $activeUserId = $request->query('user_id');
        $activeUser = null;

        if ($activeUserId) {
            $activeUser = $users->firstWhere('id', (int) $activeUserId);
        }

        return view('admin.chats.index', [
            'users' => $users,
            'activeUser' => $activeUser,
        ]);
    }

    public function list($locale, Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'after_id' => ['nullable', 'integer'],
        ]);

        $query = ChatMessage::where('user_id', $data['user_id']);

        if (!empty($data['after_id'])) {
            $query->where('id', '>', $data['after_id']);
        }

        $messages = $query->orderBy('id')->get();

        $payload = $messages->map(function (ChatMessage $message) {
            return [
                'id' => $message->id,
                'sender_type' => $message->sender_type,
                'content' => $message->content,
                'created_at' => $message->created_at ? $message->created_at->toDateTimeString() : null,
            ];
        });

        return response()->json(['messages' => $payload]);
    }

    public function store($locale, Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'content' => ['required', 'string'],
        ]);

        $message = ChatMessage::create([
            'user_id' => $data['user_id'],
            'sender_type' => 'admin',
            'content' => $data['content'],
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
