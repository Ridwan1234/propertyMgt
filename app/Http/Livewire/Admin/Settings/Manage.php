<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;

class Manage extends Component
{

    public $currencyName;
    public $currencySymbol;
    public $invoiceGenerationDate;
    public $invoiceDueDays;

    protected $rules = [
        'currencyName' => 'required',
        'currencySymbol' => 'required',
        'invoiceGenerationDate' => 'required|numeric',
        'invoiceDueDays' => 'required|numeric'

    ];

    public function mount()
    {
        $this->currencyName = setting('currency_name', 'GBP');
        $this->currencySymbol = setting('currency_symbol', '£');
        $this->invoiceGenerationDate = setting('invoice_generated_on', '1');
        $this->invoiceDueDays = setting('invoice_due_in_days', '7');

    }

    public function render()
    {
        return view('livewire.admin.settings.manage');
    }

    public function saveSettings()
    {
        $this->validate();

       // $settings = setting()->all();

        setting(['currency_name' => $this->currencyName]);
        setting(['currency_symbol' => $this->currencySymbol]);
        setting(['invoice_generated_on' => $this->invoiceGenerationDate]);
        setting(['invoice_due_in_days' => $this->invoiceDueDays]);



        setting()->save();

        session()->flash('message', 'Settings successfully updated.');
    }
}
