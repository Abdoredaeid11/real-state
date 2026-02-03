<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ChatMessage;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $user = Auth::user();

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'content' => $request->input('content'),
            'status' => 'pending',
        ]);

        // Also save as a chat message so the user sees what they sent in the chat history
        ChatMessage::create([
            'user_id' => $user->id,
            'sender_type' => 'user',
            'content' => $request->input('content'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket created successfully.',
            'ticket' => $ticket
        ]);
    }
}
