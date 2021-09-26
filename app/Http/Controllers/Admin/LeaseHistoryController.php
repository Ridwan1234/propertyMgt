<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lease;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class LeaseHistoryController extends Controller
{

    public function index()
    {
        if (\request()->ajax()) {

            $leases = Lease::with(['leasable', 'tenant'])
                ->withSum('bills', 'amount')
                ->onlyTrashed()
                ->latest()
                ->get();

            return DataTables::of($leases)
                ->addIndexColumn()
                ->addColumn('tenant', function ($lease) {
                    return $lease->tenant->fname ?? 'No Tenant';
                })
                ->addColumn('rent', function ($lease) {
                    return setting('currency_symbol') . ' ' . number_format($lease->leasable->rent ?? 0, 2);
                })
                ->addColumn('title', function ($lease) {
                    return $lease->leasable->title ?? 'DELETED PROPERTY';
                })
                ->addColumn('type', function ($lease) {
                    return $lease->type ?? '';
                })
                ->editColumn('start_date', function ($lease) {
                    return Carbon::parse($lease->start_date)->format('d M Y');
                })
                ->editColumn('end_date', function ($lease) {
                    return Carbon::parse($lease->end_date)->format('d M Y');
                })
                ->addColumn('action', function ($lease) {
                    return view('admin.lease_history.action', compact('lease'))->render();
                })
                ->editColumn('bills_sum_amount', function ($lease) {
                    return setting('currency_symbol') . ' ' . number_format($lease->bills_sum_amount, 2);
                })
                ->rawColumns(['action', 'type'])
                ->make('true');
        }

        return view('admin.lease_history.index');
    }


    public function destroy($id)
    {
        $lease = Lease::with(['leasable', 'tenant', 'bills', 'leaseDocuments'])->onlyTrashed()->findOrFail($id);

        $lease->bills()->delete();

        try {
            foreach ($lease->leaseDocuments as $document) {
                unlink(public_path($document->document));
            }
        }
        catch (\Exception $exception){
            Log::error($exception);
        }


        $lease->leaseDocuments()->delete();

        $lease->forceDelete();

        return redirect()->route('admin.lease-history.index')->with('success', 'Tenant lease has been completely deleted');
    }
}
