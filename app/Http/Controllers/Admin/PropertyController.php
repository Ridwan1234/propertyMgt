<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PropertyController extends Controller
{

    public function index()
    {
        if (\request()->ajax()) {

            $properties = Property::with('landlord')->withCount('propertyUnits')->latest()->get();

            return DataTables::of($properties)
                ->addIndexColumn()
                ->addColumn('actions', function ($property) {
                    return view('admin.property.partial.actions', compact('property'))->render();
                })
                ->editColumn('status', function ($property) {
                    return view('admin.property.partial.status', compact('property'))->render();
                })
                ->addColumn('landlord', function ($property) {
                    return $property->landlord->fname ?? 'No Landlord';
                })
                ->editColumn('rent', function ($property) {
                    return setting('currency_symbol') . ' ' . number_format($property->rent, 2);
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }


        return view('admin.property.index');
    }


    public function create()
    {
        return view('admin.property.create');
    }


    public function show($id)
    {
        $property = Property::with(['galleries', 'propertyUnits', 'leases'])->findOrFail($id);

        return view('admin.property.show', compact('property'));
    }


    public function edit($id)
    {
       return view('admin.property.edit',compact('id'));

    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $property = Property::with(['galleries', 'propertyUnits', 'leases', 'inventories'])->findOrFail($id);

        foreach ($property->galleries as $gallery) {
            unlink(public_path($gallery->image));
        }
        $property->galleries()->delete();
        $property->leases()->delete();
        $property->inventories()->delete();

        $property->delete();

        return redirect()->route('admin.property.index')
            ->with('success', 'Property together with its associated leases,galleries,property units has been deleted');

    }
}
