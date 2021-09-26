<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lease;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepositController extends Controller
{

    public function __invoke()
    {
        if (\request()->ajax()) {
            $deposits = Lease::with(['leasable', 'tenant'])->whereNotNull('deposit')->latest()->get();

            return DataTables::of($deposits)
                ->addIndexColumn()
                ->editColumn('deposit', function ($lease) {
                    return setting('currency_symbol') . ' ' . number_format($lease->deposit, 2);
                })
                ->editColumn('start_date', function ($lease) {
                    return Carbon::parse($lease->start_date)->format('d M Y');
                })
                ->editColumn('end_date', function ($lease) {
                    return Carbon::parse($lease->start_date)->format('d M Y');
                })
                ->addColumn('type', function ($lease) {
                    return $lease->type;
                })
                ->addColumn('title', function ($lease) {
                    return $lease->leasable->title;
                })
                ->addColumn('tenant', function ($lease) {
                    return $lease->tenant->fname ?? 'DELETED TENANT';
                })
                ->make(true);
        }

        return view('admin.report.deposits');
    }
}
