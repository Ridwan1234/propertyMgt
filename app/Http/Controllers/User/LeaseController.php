<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lease;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LeaseController extends Controller
{

    public function __construct()
    {
        //$this->middleware('role:tenant');
    }

    public function index()
    {
        if (\request()->ajax()) {

            $leases = Lease::with(['leasable'])
                ->withSum('bills', 'amount')
                ->where('tenant_id',auth()->id())
                ->latest()
                ->get();

            return DataTables::of($leases)
                ->addIndexColumn()
                              ->addColumn('rent', function ($lease) {
                    return setting('currency_symbol') . ' ' . number_format($lease->leasable->rent, 2);
                })
                ->addColumn('title', function ($lease) {
                    return $lease->leasable->title;
                })
                ->addColumn('type', function ($lease) {
                    return $lease->type;
                })
                ->editColumn('start_date', function ($lease) {
                    return Carbon::parse($lease->start_date)->format('d M Y');
                })
                ->editColumn('end_date', function ($lease) {
                    return Carbon::parse($lease->end_date)->format('d M Y');
                })
                ->addColumn('action', function ($lease) {
                    return view('user.lease.partial.action', compact('lease'))->render();
                })
                ->editColumn('bills_sum_amount', function ($lease) {
                    return setting('currency_symbol') . ' ' . number_format($lease->bills_sum_amount, 2);
                })
                ->rawColumns(['action', 'type'])
                ->make('true');
        }
        return view('user.lease.index');
    }






    public function show($id)
    {
        $lease = Lease::with(['leasable', 'tenant', 'bills'])->findOrFail($id);

        return view('user.lease.show', compact('lease'));
    }





}
