<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagePermissionsController extends Controller
{

    public function __invoke($id)
    {
        return view('admin.manage_users.permissions',compact('id'));
    }
}
