<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class LandlordController extends Controller
{

    public function index()
    {
        if (\request()->ajax()) {
            $landlords = User::with(['landlordProfile'])->whereRoleIs('landlord')->withCount(['properties', 'propertyUnits'])->latest()->get();

            return DataTables::of($landlords)
                ->addIndexColumn()
                ->addColumn('stats', function ($landlord) {
                    return view('admin.landlord.partials.stats', compact('landlord'))->render();
                })
                ->addColumn('actions', function ($landlord) {
                    return view('admin.landlord.partials.actions', compact('landlord'))->render();
                })
                ->addColumn('identityNo', function ($landlord) {
                    return $landlord->landlordProfile->identity ?? 'NO IDENTITY';
                })
                ->addColumn('address', function ($landlord) {
                    return $landlord->landlordProfile->address ?? 'NO ADDRESS';
                })
                ->rawColumns(['stats', 'actions'])
                ->make(true);
        }

        return view('admin.landlord.index');
    }


    public function create()
    {
        return view('admin.landlord.create');
    }


    public function show($id)
    {
        $landlord = User::with(['landlordProfile', 'properties'])->findOrFail($id);

        return view('admin.landlord.show', compact('landlord'));
    }


    public function edit($id)
    {
        return view('admin.landlord.edit',compact('id'));
    }




    public function destroy($id)
    {
        $landlord = User::with('landlordProfile')->findOrFail($id);

        $fileNameToDelete = $landlord->landlordProfile->identity_document;
        if (!empty($fileNameToDelete)) if (Storage::exists($fileNameToDelete)) {
            unlink(public_path($fileNameToDelete));
        }

        $landlord->delete();

        return redirect()->route('admin.landlord.index')->with('success', 'Landlord has been deleted');
    }
}
