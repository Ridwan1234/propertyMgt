<?php

namespace App\Http\Livewire\Admin\Invoice;

use App\Models\Invoice;
use Livewire\Component;

class EditInvoice extends Component
{

    public $invoiceId;

    public $payableRent;
    public $payableBills;


    protected $rules = [
        'payableRent' => 'required|numeric',
        'payableBills' => 'nullable|numeric',
    ];

    public function mount()
    {
        $invoice = Invoice::findOrFail($this->invoiceId);
        $this->payableRent = $invoice->rent;
        $this->payableBills = $invoice->included_bills;
    }


    public function render()
    {
        return view('livewire.admin.invoice.edit-invoice');
    }

    public function updateInvoice()
    {
        $this->validate();

        $invoice = Invoice::findOrFail($this->invoiceId);

        $invoice->update([
            'rent' => $this->payableRent,
            'included_bills' => $this->payableBills ? $this->payableBills : 0.0,
        ]);

        session()->flash('success', 'Invoice payable rent and included bills have been updated');

        return redirect()->route('admin.invoice.edit', $invoice->id);

    }
}
