@extends('layout.user')

@section('content')

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="form-inline">

                        <a href="javascript: void(0);" class="btn btn-blue btn-sm ml-1">
                            <i class="mdi mdi-filter-variant"></i> Back To Invoices
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Invoice Details</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <!-- Form row -->
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <!-- Logo & title -->
                <div class="clearfix">
                    <div class="float-left">
                        <div class="auth-logo">
                            <div class="logo logo-dark">
                                <span class="logo-lg">
                                    <img src="../assets/images/logo-dark.png" alt="" height="22">
                                </span>
                            </div>

                            <div class="logo logo-light">
                                <span class="logo-lg">
                                    <img src="../assets/images/logo-light.png" alt="" height="22">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <h4 class="m-0 d-print-none">Invoice</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mt-3">
                            <p><b>Hello, {{ $invoice->tenant->name ?? 'TENANT'}}</b></p>
                            <p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
                                promises to provide high quality products for you as well as outstanding
                                customer service for every transaction. </p>
                        </div>

                    </div><!-- end col -->
                    <div class="col-md-4 offset-md-2">
                        <div class="mt-3 float-right">
                            <p class="m-b-10"><strong>Invoice Date : </strong> <span class="float-right">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ \Carbon\Carbon::parse($invoice->created_at)->format('M d,Y')}}</span></p>
                            <p class="m-b-10"><strong>Invoice Status : </strong>
                                <span class="float-right">

                                    @switch($invoice->is_paid)
                                    @case(0)
                                    <span class="badge badge-danger">Unpaid</span>
                                    @break
                                    @case(1)
                                    <span class="badge badge-success">Paid</span>
                                    @break
                                    @default

                                    @endswitch
                                </span>
                            </p>
                            <p class="m-b-10"><strong>Invoice No. : </strong> <span
                                    class="float-right">{{ $invoice->id}} </span></p>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

                <div class="row mt-3">
                    <div class="col-sm-6">
                        <h6>Billed To:</h6>
                        <address>
                            {{ $invoice->tenant->name ?? 'No Tenant'}}<br>
                            {{ $invoice->tenant->tenantProfile->address ?? ''}}<br>
                            {{ $invoice->tenant->email ?? ''}}<br>
                            <abbr title="Phone">P:</abbr> {{ $invoice->tenant->tenantProfile->phone ?? ''}}
                        </address>
                    </div> <!-- end col -->

                    <div class="col-sm-6">
                        <h6>Company</h6>
                        <address>
                            Company Name<br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mt-4 table-centered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th style="width: 20%" class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <b>Rent for {{ $invoice->leasable->title ?? 'Deleted Property'}}</b>
                                        </td>

                                        <td class="text-right font-weight-semibold">
                                            @setting('currency_symbol') {{ number_format($invoice->rent,2)}}
                                        </td>
                                    </tr>

                                    @if ($invoice->included_bills >0)
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <b> Inclusive bills</b>
                                        </td>

                                        <td class="text-right font-weight-semibold">
                                            @setting('currency_symbol') {{ number_format($invoice->included_bills,2)}}
                                        </td>
                                    </tr>
                                    @endif

                                    {{-- @forelse ($invoice->lease->bills as $bill)
                                    <tr>
                                        <td>{{$loop->iteration + 1}}</td>
                                    <td>
                                        <b>Included bill for {{ $bill->name}}</b>

                                    </td>

                                    <td class="text-right">@setting('currency_symbol')
                                        {{ number_format($bill->amount,2)}}</td>
                                    </tr>
                                    @empty

                                    @endforelse --}}


                                </tbody>
                            </table>
                        </div> <!-- end table-responsive -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-6">
                        <div class="clearfix pt-5">
                            <h6 class="text-muted">Notes:</h6>

                            <small class="text-muted">
                                All accounts are to be paid within 7 days from receipt of
                                invoice. To be paid by cheque or credit card or direct payment
                                online. If account is not paid within 7 days the credits details
                                supplied as confirmation of work undertaken will be charged the
                                agreed quoted fee noted above.
                            </small>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="float-right">
                            <p><b>Sub-total : </b> <span class="float-right">&nbsp;&nbsp;&nbsp; @setting('currency_symbol') {{ number_format($invoice->rent+ $invoice->included_bills ,2)}}</span></p>
                            <p><b>Discount : </b> <span class="float-right"> &nbsp;&nbsp;&nbsp; @setting('currency_symbol') 0.00</span></p>
                            <h3>@setting('currency_symbol') {{ number_format($invoice->rent+ $invoice->included_bills ,2)}} @setting('currency_name')</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="mt-4 mb-1">
                    <div class="text-right d-print-none">
                        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i
                                class="mdi mdi-printer mr-1"></i> Print</a>
                        <a href="#" class="btn btn-info waves-effect waves-light">Submit</a>
                    </div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->


    <!-- end row-->

</div>

@endsection