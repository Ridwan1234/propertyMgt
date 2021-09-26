<?php

namespace App\Http\Livewire\Admin\Calendar;

use App\Models\CalendarEvent;
use Carbon\Carbon;
use Livewire\Component;

class EditSchedule extends Component
{
    public $title;
    public $startDate;
    public $endDate;
    public $scheduleId;


    protected $rules=[
        'title'=>'required',
        'startDate' => 'required|date_format:d/m/Y',
        'endDate' => 'required|date_format:d/m/Y|after_or_equal:startDate',
    ];


    protected $listeners=['calendarClicked'];

    public function calendarClicked($id)
    {
        $this->scheduleId=$id;
        $event=CalendarEvent::findOrFail($id);
        $this->title=$event->title;
        $this->startDate=Carbon::parse($event->start_date)->format('d/m/Y');
        $this->endDate=Carbon::parse($event->end_date)->format('d/m/Y');

        $this->emit('openEditModal');
    }

    public function render()
    {
        return view('livewire.admin.calendar.edit-schedule');
    }

    public function updateSchedule()
    {
        $this->validate();

        $event=CalendarEvent::findOrFail($this->scheduleId);
        $event->update([
            'title'=>$this->title,
            'start_date' => Carbon::createFromFormat('d/m/Y', $this->startDate)->toDateTime(),
            'end_date' => Carbon::createFromFormat('d/m/Y', $this->endDate)->toDateTime(),
        ]);

        session()->flash('success',$event->title.' has been updated successfully');

        return redirect()->route('admin.calendar.index');



    }

    public function deleteSchedule()
    {
        $event=CalendarEvent::findOrFail($this->scheduleId);

        $event->delete();

        session()->flash('success',$event->title. ' has been deleted from the calendar');

        return redirect()->route('admin.calendar.index');
    }
}
