<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')->latest()->paginate(10);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function reply(Request $request, $local,$id)
    {
        $request->validate([
            'reply_content' => 'required|string',
        ]);
        $ticket = Ticket::findOrFail($id);
       
        // Update ticket status
        $ticket->update(['status' => 'replied']);

        // Send reply as a chat message so it appears in live chat if user comes online
        ChatMessage::create([
            'user_id' => $ticket->user_id,
            'sender_type' => 'admin',
            'content' => $request->input('reply_content'),
        ]);

        return redirect()->back()->with('success', 'Reply sent successfully.');
    }
}
