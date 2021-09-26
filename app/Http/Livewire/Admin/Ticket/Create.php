<?php

namespace App\Http\Livewire\Admin\Ticket;

use App\Models\Ticket;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{

    public $message;
    public $subject;
    public $assignedTo;
    public $priority='medium';

    protected $rules = [
        'message' => 'required',
        'subject' => 'required',
        'priority' => 'required',
    ];

    public function render()
    {

        $users = User::whereRoleIs(['admin', 'agent', 'user', 'staff'])->get();
        return view('livewire.admin.ticket.create', ['users' => $users]);
    }

    public function createTicket()
    {
        $this->validate();

        Ticket::create([
            'subject' => $this->subject,
            'priority' => $this->priority,
            'message' => $this->message,
            'author_id' => auth()->id(),
            'assigned_to' => empty($this->assignedTo) ? null : $this->assignedTo,
        ]);

        if (auth()->user()->hasRole('admin,staff,agent')) {
            return redirect()->route('admin.ticket.index');
        } else {
            return redirect()->route('user.ticket.index');
        }

    }
}
