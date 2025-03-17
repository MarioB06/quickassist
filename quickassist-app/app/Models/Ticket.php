<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titel',
        'beschreibung',
        'status',
        'prioritaet',
        'assigned_to'
    ];

    // Beziehung: Ein Ticket gehört einem Benutzer (Ersteller)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Beziehung: Ein Ticket kann Kommentare haben
    public function comments()
    {
        return $this->hasMany(TicketComment::class, 'ticket_id');
    }

    // Beziehung: Ein Ticket kann einem Benutzer zugewiesen sein
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

}
