<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PropertyController extends Controller
{

    public function index()
    {
        if (\request()->ajax()) {

            $properties = Property::withCount('propertyUnits')
                ->where('landlord_id', auth()->id())
                ->latest()->get();

            return DataTables::of($properties)
                ->addIndexColumn()
                ->addColumn('actions', function ($property) {
                    return view('user.property.partial.actions', compact('property'))->render();
                })
                ->editColumn('status', function ($property) {
                    return view('user.property.partial.status', compact('property'))->render();
                })
                ->editColumn('commission', function ($property) {
                    return $property->commission . ' %';
                })
                ->editColumn('rent', function ($property) {
                    return setting('currency_symbol') . ' ' . number_format($property->rent, 2);
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }
        return view('user.property.index');
    }


    public function show($id)
    {
        $property = Property::with(['galleries', 'propertyUnits', 'leases'])->findOrFail($id);

        return view('user.property.show', compact('property'));
    }

}
