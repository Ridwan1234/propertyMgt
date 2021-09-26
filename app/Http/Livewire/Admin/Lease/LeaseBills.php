<?php

namespace App\Http\Livewire\Admin\Lease;

use App\Models\Bill;
use Livewire\Component;

class LeaseBills extends Component
{

    public $leaseId;
    public $bills;

    protected $listeners=[
        'billAdded'=>'refreshBills'
    ];
    public function mount()
    {
        $this->bills = Bill::where('lease_id', $this->leaseId)->get();
    }

    public function render()
    {
        return view('livewire.admin.lease.lease-bills');
    }

    public function deleteBill($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->delete();

        $this->alert('success', 'Success', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  'Specified lease bill has been removed',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);

        $this->refreshBills();
    }

    public function refreshBills()
    {
        $this->bills = Bill::where('lease_id', $this->leaseId)->get();
    }
}
