<?php

namespace App\Http\Livewire\Admin\Invoice;

use App\Models\Invoice;
use Livewire\Component;

class PayNow extends Component
{

    public $invoiceId;

    public function render()
    {
        return view('livewire.admin.invoice.pay-now');
    }


    public function payNow()
    {
        $invoice = Invoice::findOrFail($this->invoiceId);
        $invoice->update(['is_paid' => true]);

        session()->flash('success', 'Invoice has been paid.');

        return redirect()->route('admin.invoice.edit', $invoice->id);

    }
}
