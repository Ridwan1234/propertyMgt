<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InventoryController extends Controller
{

    public function index()
    {

        if (\request()->ajax()) {
            $inventories = Inventory::with('inventorable')->latest()->get();

            return DataTables::of($inventories)
                ->addIndexColumn()
                ->editColumn('created_at', function ($inventory) {
                    return Carbon::parse($inventory->created_at)->format('d M Y');
                })
                ->addColumn('actions', function ($inventory) {
                    return view('admin.inventory.partial.actions', compact('inventory'))->render();
                })
                ->addColumn('title', function ($inventory) {
                    return $inventory->inventorable->title;
                })
                ->addColumn('type', function ($inventory) {
                    return $inventory->type;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.inventory.index');
    }


    public function create()
    {
        return view('admin.inventory.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $inventory = Inventory::with(['inventorable', 'images'])->findOrFail($id);

        return view('admin.inventory.show', compact('inventory'));
    }


    public function edit($id)
    {
        return view('admin.inventory.edit',compact('id'));
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $inventory=Inventory::with('images')->findOrFail($id);

        if ($inventory->images){
            foreach ($inventory->images as $inventoryImage){
                unlink(public_path($inventoryImage->image));
//                $gallery->delete();
            }
            $inventory->images()->delete();
        }
        $inventory->delete();

        return back()->with('success','Inventory entry has been deleted');
    }
}
