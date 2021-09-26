<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalendarEvent;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()) {

            $data = CalendarEvent::whereDate('start', '>=', $request->start)
                      ->whereDate('start',   '<=', $request->end)
                      ->get(['id', 'title', 'start']);

            return response()->json($data);
       }

        return view('admin.calendar.index');
    }

    public function ajax(Request $request){
        switch ($request->type) {
            case 'add':
               $event = CalendarEvent::create([
                   'title' => $request->title,
                   'start' => $request->start,
                   'user_id'=>auth()->id(),
                   //'end' => $request->end,
               ]);

               return response()->json($event);
              break;

            case 'update':
               $event = CalendarEvent::find($request->id)->update([
                   'title' => $request->title,
                   'start' => $request->start,
                   //'end' => $request->end,
               ]);

               return response()->json($event);
              break;

            case 'delete':
               $event = CalendarEvent::find($request->id)->delete();

               return response()->json($event);
              break;

            default:
              # code...
              break;
         }

    }


}
