<?php

namespace App\Http\Livewire\Admin\Lease;

use App\Models\Lease;
use Livewire\Component;

class ExpiringLeases extends Component
{

    public $days = 1;

    public function render()
    {
        $leases = Lease::with(['leasable', 'tenant'])
            ->withSum('bills', 'amount')
            ->whereBetween('end_date', [now()->subDay(), now()->addDays($this->days)])
            ->paginate(10);
        return view('livewire.admin.lease.expiring-leases', ['leases' => $leases]);
    }
}
