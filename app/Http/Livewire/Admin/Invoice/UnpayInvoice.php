<?php

namespace App\Http\Livewire\Admin\Invoice;

use App\Models\Invoice;
use Livewire\Component;

class UnpayInvoice extends Component
{

    public $invoiceId;

    public function render()
    {
        return view('livewire.admin.invoice.unpay-invoice');
    }

    public function unpayNow()
    {
        $invoice = Invoice::findOrFail($this->invoiceId);
        $invoice->update(['is_paid' => false]);
        session()->flash('success', 'Invoice payment status has been marked as unpaid.');
        return redirect()->route('admin.invoice.edit', $invoice->id);
    }
}
