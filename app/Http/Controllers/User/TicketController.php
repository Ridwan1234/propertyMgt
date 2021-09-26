<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
{

    public function index()
    {
        if (\request()->ajax()) {
            $tickets = Ticket::with(['author', 'assignee'])
                ->where('author_id', auth()->id())
                ->orWhere('assigned_to', auth()->id())
                ->latest('created_at')
                ->get();

            return DataTables::of($tickets)
                ->addIndexColumn()
                ->addColumn('author', function ($ticket) {
                    return $ticket->author->name;
                })
                ->addColumn('assignee', function ($ticket) {
                    return $ticket->assignee->name ?? '<span class="text-danger">PENDING ASSIGNATION</span>';
                })
                ->editColumn('created_at', function ($ticket) {
                    return Carbon::parse($ticket->created_at)->format('Y/m/d');
                })
                ->editColumn('priority', function ($ticket) {
                    return view('user.tickets.partial.priority', compact('ticket'))->render();
                })
                ->editColumn('status', function ($ticket) {
                    return view('user.tickets.partial.status', compact('ticket'))->render();
                })
                ->addColumn('actions', function ($ticket) {
                    return view('user.tickets.partial.actions', compact('ticket'))->render();
                })
                ->rawColumns(['assignee', 'actions', 'status', 'priority'])
                ->make(true);


        }


        return view('user.tickets.index');
    }


    public function create()
    {
        //
    }


    public function show($id)
    {
        return view('user.tickets.show', compact('id'));
    }


    public function edit($id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
