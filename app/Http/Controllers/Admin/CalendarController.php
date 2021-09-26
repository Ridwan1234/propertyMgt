<?php

namespace App\Http\Controllers\Admin;


use Acaronlex\LaravelCalendar\Calendar;
use App\Http\Controllers\Controller;
use App\Models\CalendarEvent;
use Illuminate\Http\Request;

class CalendarController extends Controller
{

    public function index()
    {

        //get all events from database

        $calendarEvents = CalendarEvent::all();

        $formatedEvents = array();
        foreach ($calendarEvents as $event) {
            $formatedEvents[] = Calendar::event(
                $event->title,
                true,
                $event->start_date,
                $event->end_date,
                $event->id
            );
        }

        $calendar = new Calendar();
        $calendar->addEvents($formatedEvents)
            ->setOptions([
                'locale' => 'en',
                'firstDay' => 0,
                'displayEventTime' => false,
                'selectable' => true,
                'initialView' => 'dayGridMonth',
                'eventLimit' => 'true',
                'headerToolbar' => [
                    'left' => 'prev,next today',
                    'center' => 'title',
                    'end' => 'dayGridMonth,dayGridWeek,dayGridDay'
                ]
            ]);
        $calendar->setId('1');
        $calendar->setCallbacks([
            'select' => 'function(selectionInfo){}',
            'eventClick' => 'function(info){
             Livewire.emit("calendarClicked",info.event.id)
            }'
        ]);
        return view('admin.calendar.index', compact('calendar'));
    }


}
