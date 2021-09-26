<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lease;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LeaseController extends Controller
{

    public function index()
    {
        if (\request()->ajax()) {

            $leases = Lease::with(['leasable', 'tenant'])
                ->withSum('bills', 'amount')
                ->latest()
                ->get();

            return DataTables::of($leases)
                ->addIndexColumn()
                ->addColumn('tenant', function ($lease) {
                    return $lease->tenant->fname ?? 'No Tenant';
                })
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
                    return view('admin.leases.partial.action', compact('lease'))->render();
                })
                ->editColumn('bills_sum_amount', function ($lease) {
                    return setting('currency_symbol') . ' ' . number_format($lease->bills_sum_amount, 2);
                })
                ->rawColumns(['action', 'type'])
                ->make('true');
        }

        return view('admin.leases.index');
    }

    public function create()
    {
        return view('admin.leases.create');
    }

    public function show($id)
    {
        $lease = Lease::with(['leasable', 'tenant', 'bills', 'leaseDocuments'])->findOrFail($id);

        return view('admin.leases.show', compact('lease'));
    }

    public function edit($id)
    {
        return view('admin.leases.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $lease = Lease::with('leasable')->findOrFail($id);

        $lease->leasable->markAsVacant();

        $lease->delete();
//        $lease = Lease::with(['leasable', 'tenant', 'bills', 'leaseDocuments'])->findOrFail($id);

//        $lease->bills()->delete();
        //
        //        foreach ($lease->leaseDocuments as $document) {
        //            unlink(public_path($document->document));
        //        }

        //$lease->leaseDocuments()->delete();

        //$lease->delete();

        return redirect()->route('admin.lease.index')->with('success', 'Tenant lease has been deleted');
    }

    public function expiring()
    {
        return view('admin.leases.expiring');
    }
}
