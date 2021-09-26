<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:tenant');
    }

    public function index()
    {

        if (\request()->ajax()) {
            $invoices = Invoice::with(['invoicable'])
                ->where('tenant_id',auth()->id())
                ->latest()
                ->get();

            return DataTables::of($invoices)
                ->addIndexColumn()

                ->editColumn('is_paid', function ($invoice) {
                    return view('user.invoice.partials.is_paid', compact('invoice'))->render();
                })
                ->addColumn('property', function ($invoice) {
                    return view('user.invoice.partials.property', compact('invoice'))->render();
                })

                ->addColumn('total_due', function ($invoice) {
                    return setting('currency_symbol') . '' . number_format($invoice->included_bills + $invoice->rent, 2);
                })
                ->addColumn('due_date', function ($invoice) {

                    return Carbon::parse($invoice->created_at)->addDays(setting('invoice_due_in_days', 7))->format('M d, Y');

                })
                ->addColumn('action', function ($invoice) {
                    return view('user.invoice.partials.action', compact('invoice'))->render();
                })
                ->rawColumns(['is_paid', 'action', 'tenant', 'property'])
                ->make(true);
        }
        return view('user.invoice.index');
    }


    public function show($id)
    {
        $invoice = Invoice::with(['tenant.tenantProfile', 'invoicable','lease'])->findOrFail($id);
        return view('user.invoice.detail', compact('invoice'));
    }

}
