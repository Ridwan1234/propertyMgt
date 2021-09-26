<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class GenerateInvoiceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Artisan::call('invoice:generate');

        $currentMonth = now()->format('m Y');

        return back()->with('success', "Invoices for month {$currentMonth} has been generated");

    }
}
