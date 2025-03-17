<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TicketCategory;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        $filter = $request->query('filter');
        $status = $request->query('status');

        $query = Ticket::with('comments');

        if ($filter === 'mine') {
            $query->where('assigned_to', $userId);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $tickets = $query->latest()->get();
        $categories = TicketCategory::all();

        return view('dashboard', compact('tickets', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titel' => 'required|string|max:255',
            'beschreibung' => 'required|string',
            'prioritaet' => 'required|in:niedrig,mittel,hoch',
        ]);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'titel' => $request->titel,
            'beschreibung' => $request->beschreibung,
            'prioritaet' => $request->prioritaet,
        ]);

        return response()->json($ticket, 201);
    }

    public function show(Ticket $ticket)
    {
        $categories = TicketCategory::all();
        $comments = $ticket->comments()->latest()->get();

        return view('tickets.show', compact('ticket', 'categories', 'comments'));
    }


    public function update(Request $request, Ticket $ticket)
    {
        if ($ticket->assigned_to !== null && $ticket->assigned_to !== auth()->id()) {
            return redirect()->route('tickets.show', $ticket)
                ->with('error', 'Du kannst dieses Ticket nicht bearbeiten.');
        }

        $request->validate([
            'prioritaet' => 'nullable|in:niedrig,mittel,hoch',
            'status' => 'nullable|in:offen,in_bearbeitung,geschlossen',
            'category_id' => 'nullable|exists:ticket_categories,id'
        ]);

        $data = $request->only(['prioritaet', 'status', 'category_id']);

        if (is_null($ticket->assigned_to) && $request->has('assign_self')) {
            $data['assigned_to'] = auth()->id();
        }

        $ticket->update($data);

        return redirect()->route('tickets.show', $ticket)->with('success', 'Ticket aktualisiert.');
    }



    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return response()->json(['message' => 'Ticket gelöscht']);
    }

}
