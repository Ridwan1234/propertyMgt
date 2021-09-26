<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyPaymentController extends Controller
{

    public function __invoke(Request $request)
    {
        return view('admin.report.company-payment');
    }
}
