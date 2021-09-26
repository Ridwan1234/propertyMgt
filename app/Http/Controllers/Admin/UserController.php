<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function index()
    {

        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'You do not have necessary permissions to perform this action.');
        }
        if (\request()->ajax()) {
            $users = User::whereRoleIs(['admin', 'agent', 'user', 'staff'])->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($user) {
                    return view('admin.manage_users.action', compact('user'))->render();
                })
                ->addColumn('role', function ($user) {
                    return $user->roles->first()->display_name;
                })
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('admin.manage_users.index');


    }


    public function create()
    {
        //
    }


    public function destroy($id)
    {
        if ($id==auth()->id()){
            return back()->with('error','Currently logged in user cannot remove associated account');
        }
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', $user->fname . ' has been deleted');
    }
}
