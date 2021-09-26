<?php

namespace App\Http\Livewire\Admin\Tenant;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class ShowInvoices extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $tenantId;
    public function render()
    {
        $invoices = Invoice::with(['invoicable'])
            ->where('tenant_id',$this->tenantId)
            ->latest()
            ->paginate(6);
        return view('livewire.admin.tenant.show-invoices',['invoices'=>$invoices]);
    }
}
