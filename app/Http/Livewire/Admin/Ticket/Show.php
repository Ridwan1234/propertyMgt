<?php

namespace App\Http\Livewire\Admin\Ticket;

use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Show extends Component
{
    public $ticketId;
    public $reportedBy;
    public $assignedTo;
    public $assigneeId;
    public $createdOn;
    public $updatedOn;
    public $status;
    public $priority;
    public $subject;
    public $message;
    public $sortOrder = 'asc';

    public $reply;

    protected $listeners = [
        'confirmDelete',
        'cancelDelete',

    ];

    public function mount()
    {
        $ticket = Ticket::with(['author', 'assignee'])->findOrFail($this->ticketId);

        $this->reportedBy = $ticket->author->name;
        $this->assignedTo = $ticket->assignee->name ?? 'NOT ASSIGNED TO ANYONE';
        $this->createdOn = Carbon::parse($ticket->created_at)->format('d M Y H:i');
        $this->status = $ticket->status;
        $this->priority = $ticket->priority;
        $this->subject = $ticket->subject;
        $this->message = $ticket->message;
        $this->assigneeId = $ticket->assigned_to;


    }

    public function render()
    {
        $comments = TicketComment::where('ticket_id', $this->ticketId)
            ->orderBy('created_at', $this->sortOrder)
            ->get();

        $users = User::whereRoleIs(['admin', 'staff','agent'])->get();
        return view('livewire.admin.ticket.show',
            ['comments' => $comments,
                'users' => $users,
            ]);
    }

    public function updatedStatus()
    {
        Ticket::find($this->ticketId)->update(['status' => $this->status]);
        $this->alert('success', 'You have updated ticket status to ' . $this->status, [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);
    }

    public function updatedPriority()
    {
        Ticket::find($this->ticketId)->update(['priority' => $this->priority]);
        $this->alert('success', 'You have updated ticket priority to ' . $this->priority, [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);

    }

    public function updatedAssigneeId()
    {

            Ticket::find($this->ticketId)
                ->update(
                    ['assigned_to' => empty($this->assigneeId) ? null :$this->assigneeId,
                    ]);
            $this->alert('success', 'Ticket assignee has been updated', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => '',
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);




    }

    public function replyTicket()
    {
        $this->validate(['reply' => 'required']);

        TicketComment::create([
            'message' => $this->reply,
            'ticket_id' => $this->ticketId,
            'responder_id' => auth()->id()
        ]);

        $this->reset('reply');

        $this->alert('success', 'You have replied to this ticket', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
        ]);


    }

    public function triggerDelete()
    {
        $this->confirm('Do you want to delete this ticket ?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Nope',
            'onConfirmed' => 'confirmDelete',
            'onCancelled' => 'cancelDelete'
        ]);
    }

    public function confirmDelete()
    {

        $ticket = Ticket::findOrFail($this->ticketId);

        $ticket->delete();

        $this->alert(
            'success',
            'Thanks! consider giving it a star on github.'
        );

        return redirect()->route('admin.ticket.index');

    }

    public function cancelDelete()
    {
        $this->alert('info', 'Understood');
    }
}
