<?php

namespace App\View\Components;

use App\Models\Ticket;
use Illuminate\View\Component;

class UserTickets extends Component
{
    public $openTickets;
    public $closedTickets;

    public function __construct()
    {
        $this->openTickets=Ticket::where('status','open')
            ->where('author_id',auth()->id())
            ->orWhere('assigned_to',auth()->id())
            ->count();

        $this->closedTickets=Ticket::where('status','closed')
            ->where('author_id',auth()->id())
            ->orWhere('assigned_to',auth()->id())
            ->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.user-tickets');
    }
}
