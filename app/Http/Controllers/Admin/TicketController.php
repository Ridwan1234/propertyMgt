<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
{

    public function index()
    {
        if (\request()->ajax()) {
            $tickets = Ticket::with(['author', 'assignee'])
                ->latest()->get();

            return DataTables::of($tickets)
                ->addColumn('author', function ($ticket) {
                    return $ticket->author->name;
                })
                ->addColumn('assignee', function ($ticket) {
                    return $ticket->assignee->name ?? '<span class="text-danger">NO ASSIGNEE</span>';
                })
                ->editColumn('created_at', function ($ticket) {
                    return Carbon::parse($ticket->created_at)->format('Y/m/d');
                })
                ->editColumn('priority', function ($ticket) {
                    return view('admin.tickets.partial.priority', compact('ticket'))->render();
                })
                ->editColumn('status', function ($ticket) {
                    return view('admin.tickets.partial.status', compact('ticket'))->render();
                })
                ->addColumn('actions', function ($ticket) {
                    return view('admin.tickets.partial.actions', compact('ticket'))->render();
                })
                ->rawColumns(['assignee', 'actions', 'status', 'priority'])
                ->make(true);


        }




        return view('admin.tickets.index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('admin.tickets.show', compact('id'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
