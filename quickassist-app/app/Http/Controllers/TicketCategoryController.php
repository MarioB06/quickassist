<?php

namespace App\Http\Controllers;

use App\Models\TicketCategory;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketCategoryController extends Controller
{
    public function show(Ticket $ticket)
    {
        $categories = TicketCategory::all();
        $comments = $ticket->comments()->latest()->get();

        return view('tickets.show', compact('ticket', 'categories', 'comments'));
    }
}