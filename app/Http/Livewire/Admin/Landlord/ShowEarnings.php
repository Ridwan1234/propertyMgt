<?php

namespace App\Http\Livewire\Admin\Landlord;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class ShowEarnings extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $landlordId;
    public function render()
    {
        $payments = Invoice::selectRaw("
                                count(id) AS payments_count,
                                DATE_FORMAT(created_at, '%M %Y') AS payment_month,
                                SUM(rent) AS total_collected,
                                SUM(rent*commission/100) AS company_deduction,
                                max(created_at) as createdAt
                            ")
            ->where('landlord_id', $this->landlordId)
            ->orderBy('createdAt', 'desc')
            ->groupBy('payment_month')
            ->paginate('5');
        return view('livewire.admin.landlord.show-earnings',['payments'=>$payments]);
    }
}
