<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{


    protected $guarded = [];

    //A ticket is raised by author
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    //A ticket is assigned to assignee

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function comments()
    {
        return $this->hasMany(TicketComment::class,'ticket_id','id');
    }
}
