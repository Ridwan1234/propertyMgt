<?php

namespace App\View\Components;

use App\Models\Property;
use App\Models\PropertyUnit;
use App\Models\User;
use Illuminate\View\Component;

class AdminDashboardWidget extends Component
{
    public $totalLandlords;
    public $totalTenants;
    public $totalProperties;
    public $totalUnits;

    public function __construct()
    {
        $this->totalLandlords = User::whereRoleIs('landlord')->count();
        $this->totalTenants = User::whereRoleIs('tenant')->count();
        $this->totalProperties = Property::count();
        $this->totalUnits = PropertyUnit::count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin-dashboard-widget');
    }
}
