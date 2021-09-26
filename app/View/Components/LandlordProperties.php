<?php

namespace App\View\Components;

use App\Models\Property;
use App\Models\PropertyUnit;
use Illuminate\View\Component;

class LandlordProperties extends Component
{
   public $totalProperties;
   public $totalUnits;
    public function __construct()
    {
        $this->totalProperties=Property::where('landlord_id',auth()->id())->count();
        $this->totalUnits=PropertyUnit::where('landlord_id',auth()->id())->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.landlord-properties');
    }
}
