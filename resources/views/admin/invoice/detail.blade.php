@extends('layout.main')

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="form-inline">

                            <a href="{{ route('admin.invoice.show',\Carbon\Carbon::parse($invoice->created_at)->format('F Y')) }} "
                               class="btn btn-dark btn-sm ml-1">
                                <i class="mdi mdi-keyboard-backspace"></i> {{ __('invoice.Back To Invoices') }}
                            </a>
                        </form>
                    </div>
                    <h4 class="page-title"> {{ __('invoice.Invoice Details') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @if (session()->has('success'))
            <div class="row d-print-none">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>

    @endif


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
                                <p class="m-b-10"><strong>{{__('invoice.Invoice Date')}} : </strong> <span
                                        class="float-right">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ \Carbon\Carbon::parse($invoice->created_at)->format('M d,Y')}}</span></p>
                                <p class="m-b-10"><strong>{{__('invoice.STATUS')}} : </strong>
                                    <span class="float-right">

                                    @switch($invoice->is_paid)
                                            @case(0)
                                            <span class="badge badge-danger">{{ __('invoice.Unpaid') }}</span>
                                            @break
                                            @case(1)
                                            <span class="badge badge-success">{{ __('invoice.Paid') }}</span>
                                            @break
                                            @default

                                        @endswitch
                                </span>
                                </p>
                                <p class="m-b-10"><strong>{{__('invoice.Invoice No.')}} : </strong> <span
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
                                <abbr title="Phone">{{ $invoice->tenant->tenantProfile->phone ?? ''}}</abbr>
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
                                        <th>{{__('invoice.Description')}}</th>
                                        <th style="width: 20%" class="text-right">{{__('invoice.Total')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <b>{{ __('invoice.Rent for')}} {{ $invoice->leasable->title ?? 'Deleted Property'}}</b>
                                        </td>

                                        <td class="text-right font-weight-semibold">
                                            @setting('currency_symbol') {{ number_format($invoice->rent,2)}}
                                        </td>
                                    </tr>

                                    @if ($invoice->included_bills >0)
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <b> {{ __('invoice.Inclusive bills')}}</b>
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
                                <p><b>{{__('invoice.Sub-total')}} : </b> <span class="float-right">&nbsp;&nbsp;&nbsp;
                                    @setting('currency_symbol')
                                    {{ number_format($invoice->rent+ $invoice->included_bills ,2)}}</span></p>
                                <p><b>{{__('invoice.Discount')}} : </b> <span class="float-right"> &nbsp;&nbsp;&nbsp;
                                    @setting('currency_symbol') 0.00</span></p>
                                <h3>@setting('currency_symbol')
                                    {{ number_format($invoice->rent+ $invoice->included_bills ,2)}}
                                    @setting('currency_name')</h3>
                            </div>
                            <div class="clearfix"></div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="d-flex align-items-start flex-row-reverse mt-4 mb-1 d-print-none">
                        @if ($invoice->is_paid==0)


                            @permission('invoice-update')

                            @livewire('admin.invoice.pay-now', ['invoiceId' => $invoice->id])



                            <button data-toggle="modal" data-target="#edit-modal"
                                    class="btn btn-sm btn-soft-success waves-effect waves-light mr-1 ml-1">
                                {{ __('invoice.Edit') }}
                            </button>

                        @else



                            @livewire('admin.invoice.unpay-invoice', ['invoiceId' => $invoice->id])

                            @endpermission
                        @endif
                        <a href="javascript:window.print()"
                           class="mr-1 btn btn-sm btn-primary waves-effect waves-light"><i
                                class="mdi mdi-printer mr-1"></i> {{__('invoice.Print')}}</a>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->


        <!-- Standard modal content -->
        <div id="edit-modal" class="modal fade d-print-none" tabindex="-1" role="dialog"
             aria-labelledby="edit-modalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="edit-modalLabel">{{__('invoice.Edit Invoice')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    @livewire('admin.invoice.edit-invoice', ['invoiceId' => $invoice->id])
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- end row-->

    </div>

@endsection
