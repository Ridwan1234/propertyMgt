<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IncomeController extends Controller
{

    public function __invoke()
    {


        if (\request()->ajax()) {
            $payments = Invoice::selectRaw("
                                count(id) AS payments_count,
                                DATE_FORMAT(created_at, '%M %Y') AS payment_month,
                                SUM(rent) AS total_collected,
                                SUM(rent*commission/100) AS company_deduction,
                                max(created_at) as createdAt
                            ")
                ->where('landlord_id', auth()->id())
                ->orderBy('createdAt', 'desc')
                ->groupBy('payment_month')
                ->get();

            return DataTables::of($payments)
                ->addIndexColumn()
                ->editColumn('total_collected', function ($payment) {
                    return setting('currency_symbol') . '  ' . number_format($payment->total_collected, 2);
                })
                ->editColumn('company_deduction', function ($payment) {
                    return setting('currency_symbol') . '  ' . number_format($payment->company_deduction, 2);
                })
                ->addColumn('net_income', function ($payment) {
                    return setting('currency_symbol') . '  ' . number_format($payment->total_collected - $payment->company_deduction, 2);
                })
                ->make(true);
        }


        return view('user.income.index');

    }
}
