<?php

namespace App\Listeners;

use App\Models\Property;
use App\Models\PropertyUnit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MarkPropertyAsOccupied
{

    public function __construct()
    {
        //
    }


    public function handle($event)
    {
        if ($event->lease->type=='UNIT'){
            $unit=PropertyUnit::with('property')->find($event->lease->leasable_id);
            $unit->update(['status'=>'occupied']);
            $unit->property()->update(['status'=>'unavailable']);
        }
        else{
            $property=Property::with('propertyUnits')->find($event->lease->leasable_id);
            $property->update(['status'=>'occupied']);
            $property->propertyUnits()->update(['status'=>'unavailable']);

        }
    }
}
