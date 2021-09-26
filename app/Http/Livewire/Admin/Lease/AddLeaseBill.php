<?php

namespace App\Http\Livewire\Admin\Lease;

use App\Models\Bill;
use Livewire\Component;

class AddLeaseBill extends Component
{

    public $leaseId;

    public $billName;
    public $billAmount;

    protected $rules=[
        'billName'=>'required',
        'billAmount'=>'required|numeric',
    ];
    public function render()
    {
        return view('livewire.admin.lease.add-lease-bill');
    }

    public function addBill()
    {
        $this->validate();

        Bill::create([
            'name'=>$this->billName,
            'amount'=>$this->billAmount,
            'lease_id'=>$this->leaseId,
        ]);

        $this->alert(
            'success',
            'New bill has been added.'
        );
        $this->emit('billAdded');
        $this->emit('closeBillModal');

        $this->reset(['billAmount']);
    }
}
