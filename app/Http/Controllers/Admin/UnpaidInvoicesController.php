<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UnpaidInvoicesController extends Controller
{

    public function __invoke(Request $request)
    {
        if (\request()->ajax()) {
            $invoice = Invoice::with(['tenant', 'invoicable'])
                ->unpaid()
                ->get();

            return DataTables::of($invoice)
                ->addIndexColumn()

                ->editColumn('is_paid', function ($invoice) {
                    return view('admin.invoice.partials.is_paid', compact('invoice'))->render();
                })
                ->addColumn('property', function ($invoice) {
                    return view('admin.invoice.partials.property', compact('invoice'))->render();
                })
                ->addColumn('tenant', function ($invoice) {
                    return $invoice->tenant->fname ?? '<span class="">DELETED TENANT</span>';
                })
                ->addColumn('total_due', function ($invoice) {
                    return setting('currency_symbol') . '' . number_format($invoice->included_bills + $invoice->rent, 2);
                })
                ->addColumn('due_date', function ($invoice) {

                    return Carbon::parse($invoice->created_at)->addDays(setting('invoice_due_in_days', 7))->format('M d, Y');

                })
                ->addColumn('action', function ($invoice) {
                    return view('admin.invoice.partials.action', compact('invoice'))->render();
                })
                ->rawColumns(['is_paid', 'action', 'tenant', 'property'])
                ->make(true);
        }

        return view('admin.report.unpaid_invoices');
    }
}
