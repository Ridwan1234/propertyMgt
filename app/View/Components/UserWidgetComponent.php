<?php

namespace App\View\Components;

use App\Models\Invoice;
use App\Models\Lease;
use Illuminate\View\Component;

class UserWidgetComponent extends Component
{
    public $unpaidInvoices;
    public $activeLeases;

    public function __construct()
    {
        $this->activeLeases = Lease::where('tenant_id', auth()->id())
            ->count();
        $this->unpaidInvoices = Invoice::where('tenant_id', auth()->id())
            ->where('is_paid', false)
            ->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.user-widget-component');
    }
}
