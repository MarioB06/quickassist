<?php

namespace App\Http\Controllers;

use App\Models\TicketComment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketCommentController extends Controller
{
    public function index()
    {
        $comments = TicketComment::latest()->get();
        return response()->json($comments);
    }

    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'kommentar' => 'required|string|max:1000'
        ]);

        TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'kommentar' => $request->kommentar
        ]);

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Kommentar hinzugefügt.');
    }


    public function show(TicketComment $ticketComment)
    {
        return response()->json($ticketComment);
    }

    public function destroy(TicketComment $ticketComment)
    {
        $ticketComment->delete();
        return response()->json(['message' => 'Kommentar gelöscht']);
    }
}
