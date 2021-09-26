<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{

    public function index()
    {
        if (\request()->ajax()) {
            $invoices = Invoice::selectRaw("
                                count(id) AS invoices_count,
                                DATE_FORMAT(created_at, '%M %Y') AS invoicable_month,
                                SUM(rent) AS invoice_rents,
                                SUM(included_bills) AS invoice_bills,
                                max(created_at) as createdAt
                            ")
                ->orderBy('createdAt', 'desc')
                ->groupBy('invoicable_month')
                ->get();

            return DataTables::of($invoices)
                ->addIndexColumn()
                ->addColumn('show', function ($invoice) {
                    return view('admin.invoice.partials.show', compact('invoice'))->render();
                })
                ->editColumn('invoices_total_due', function ($invoice) {
                    return setting('currency_symbol') . ' ' . number_format($invoice->invoice_bills + $invoice->invoice_rents, 2);
                })
                ->rawColumns(['show'])
                ->make(true);

        }

        return view('admin.invoice.index');
    }

    public function show($id)
    {

        if (\request()->ajax()) {
            $invoice = Invoice::with(['tenant', 'invoicable'])
                ->where(DB::raw("DATE_FORMAT(created_at, '%M %Y')"), "=", $id)
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

        return view('admin.invoice.show', compact('id'));

    }


    public function edit($id)
    {
        $invoice = Invoice::with(['tenant.tenantProfile', 'invoicable','lease'])->findOrFail($id);
        return view('admin.invoice.detail', compact('invoice'));
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
