<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyUnit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PropertyUnitController extends Controller
{

    public function index()
    {

        if (\request()->ajax()) {
            $rooms = PropertyUnit::with('property')->latest()->get();

            return DataTables::of($rooms)
                ->addIndexColumn()
                ->editColumn('status', function ($room) {
                    return view('admin.property_unit.partial.status',compact('room'))->render();
                })
                ->addColumn('actions', function ($room) {
                    return view('admin.property_unit.partial.actions',compact('room'))->render();
                })
                ->addColumn('property', function ($room) {
                    return $room->property->title ?? 'NO PROPERTY';
                })
                ->editColumn('rent',function($room){
                    return setting('currency_symbol').' '.number_format($room->rent,2);
                })
                ->editColumn('caution',function($room){
                    return setting('currency_symbol').' '.number_format($room->caution,2);
                })
                ->editColumn('service',function($room){
                    return setting('currency_symbol').' '.number_format($room->service,2);
                })
                ->addColumn('total', function ($room) {
                    $total = $room->rent + $room->caution + $room->service ?? '0';
                    return setting('currency_symbol').' '.number_format($total,2);
                })
                ->addColumn('cautionTotal', function ($room) {
                  $cautionTotal = $room->sum('caution');
                    return setting('currency_symbol').' '.number_format($cautionTotal,2);
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        // $rooms = PropertyUnit::with('property')->latest()->get();
        // $serviceTotal = $rooms->sum('caution');

        // return  $serviceTotal;

        return view('admin.property_unit.index');
    }

    public function create()
    {
        return view('admin.property_unit.create');
    }


    public function show($id)
    {
        $unit=PropertyUnit::with(['property','galleries','leases'])->findOrFail($id);
        return view('admin.property_unit.show',compact('unit'));
    }


    public function edit($id)
    {
        return view('admin.property_unit.edit',compact('id'));
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $unit = PropertyUnit::with(['galleries','leases', 'inventories'])->findOrFail($id);

        foreach ($unit->galleries as $gallery) {
            unlink(public_path($gallery->image));
        }
        $unit->galleries()->delete();
        $unit->leases()->delete();
        $unit->inventories()->delete();

        $unit->delete();

        return redirect()->route('admin.property-unit.index')
            ->with('success', 'Property unit together with its associated leases,galleries has been deleted');

    }
}
