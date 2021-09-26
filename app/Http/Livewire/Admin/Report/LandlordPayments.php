<?php

namespace App\Http\Livewire\Admin\Report;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LandlordPayments extends Component
{

    public $month;

    public $monthInt;
    public $yearInt;

    public function mount()
    {
        $this->month=now()->format('M Y');
        $this->yearInt=now()->year;
        $this->monthInt=now()->month;
    }

    public function updatedMonth()
    {
        $unformatedMonth=Carbon::createFromFormat('M Y',$this->month);

        $this->monthInt=$unformatedMonth->month;
        $this->yearInt=$unformatedMonth->year;
    }

    public function render()
    {

        //SUM(rent*commission/100) AS company_deduction,
//        $payments = Invoice::selectRaw("
//         count(id) AS no_of_invoices,
//          SUM(rent) AS total_collected,
//
//           landlord_id,
//           created_at,
//        ")
//          //  ->where(DB::raw("DATE_FORMAT(created_at, '%M %Y')"), "=", 'Jan 2021')
//           // ->groupBy('landlord_id')
//            ->get();

        $payments=Invoice::with('landlord')
            ->selectRaw("
        count(id) AS no_of_invoices,
        landlord_id,
        SUM(rent) AS total_collected,
        SUM(rent*commission/100) AS company_deduction

        ")
            ->whereMonth('created_at',$this->monthInt)
            ->whereYear('created_at',$this->yearInt)
           //->where(DB::raw("DATE_FORMAT(created_at, '%M %Y')"), "=", 'Jan 2021')
            ->groupBy('landlord_id')
            ->get();
        return view('livewire.admin.report.landlord-payments', ['payments' => $payments]);
    }
}
