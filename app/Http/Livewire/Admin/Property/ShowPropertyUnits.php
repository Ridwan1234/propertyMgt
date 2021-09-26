<?php

namespace App\Http\Livewire\Admin\Property;

use App\Models\Property;
use App\Models\PropertyUnit;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPropertyUnits extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $propertyId;

    public function render()
    {

        $units=PropertyUnit::where('property_id',$this->propertyId)->latest()->paginate(6);
        return view('livewire.admin.property.show-property-units',['units'=>$units]);
    }
}
