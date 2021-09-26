<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function __invoke()
    {
        if (auth()->user()->hasRole('admin')){
            return view('admin.setting.index');
        }

        else{
            abort(403,'You do not have necessary permissions to perform this action.');
        }
    }
}
