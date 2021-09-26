<?php

namespace App\Http\Livewire\Admin\Calendar;

use App\Models\CalendarEvent;
use Carbon\Carbon;
use Livewire\Component;

class AddSchedule extends Component
{

    public $title;
    public $startDate;
    public $endDate;

    protected $rules=[
        'title'=>'required',
        'startDate' => 'required|date_format:d/m/Y',
        'endDate' => 'required|date_format:d/m/Y|after_or_equal:startDate',
    ];

    public function render()
    {
        return view('livewire.admin.calendar.add-schedule');
    }

    public function addSchedule()
    {
        $this->validate();

        $calendar=CalendarEvent::create([
            'title'=>$this->title,
            'start_date' => Carbon::createFromFormat('d/m/Y', $this->startDate)->toDateTime(),
            'end_date' => Carbon::createFromFormat('d/m/Y', $this->endDate)->toDateTime(),
        ]);

        session()->flash('success','Event has been created');

        return redirect()->route('admin.calendar.index');
    }
}
