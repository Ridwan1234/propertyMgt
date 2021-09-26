<?php

namespace App\View\Components;

use App\Models\Ticket;
use Illuminate\View\Component;

class AdminTicketsStatistics extends Component
{
    public $totalTickets;
    public $totalOpenTickets;
    public $totalClosedTickets;

    public function __construct()
    {
        $this->totalTickets=Ticket::count();
        $this->totalOpenTickets=Ticket::where('status','open')->count();

        $this->totalClosedTickets=$this->totalTickets-$this->totalOpenTickets;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin-tickets-statistics');
    }
}
