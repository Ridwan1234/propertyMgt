<div>

    @push('header-css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css"
        integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A=="
        crossorigin="anonymous" />

    @endpush

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                   
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <label class="font-weight-bold">Select Month</label>
                            <div class="input-group">
                                <input type="text" class="form-control font-weight-bold" data-provide="datepicker"
                                    data-date-format="M yyyy" 
                                    data-date-start-view="1"
                                    data-date-min-view-mode="1"
                                    data-date-max-view-mode="2" 
                                    data-date-clear-btn="false"
                                    data-date-today-highlight="true" 
                                    data-date-autoclose="true"
                                    wire:model="month"
                                    id="start_date" readonly onchange="this.dispatchEvent(new InputEvent('input'))">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="spinner-border text-primary" wire:loading wire:target="month" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>

                    @if (count($payments)>0)
                    <div class="row">
                       
                        <div class="col-lg-4 col-xl-3">
                            <div class="card-box bg-pattern">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="avatar-md bg-success rounded">
                                            <i class="fe-dollar-sign avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="text-right">
                                            <h5 class="text-dark my-1">@setting('currency_symbol') <span data-plugin="counterup"> {{ number_format($payments->sum('total_collected'),2) }}</span></h5>
                                            <p class="text-muted mb-0 text-truncate">Total Rent Collected</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card-box-->
                        </div> <!-- end col -->
                        <div class="col-lg-4 col-xl-3">
                            <div class="card-box bg-pattern">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="avatar-md bg-warning rounded">
                                            <i class="fe-dollar-sign avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="text-right">
                                            <h5 class="text-dark my-1">@setting('currency_symbol')<span data-plugin="counterup">{{ number_format($payments->sum('company_deduction'),2) }}</span></h5>
                                            <p class="text-muted mb-0 text-truncate">Total Company Profit</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card-box-->
                        </div> <!-- end col -->
                        <div class="col-lg-4 col-xl-3">
                            <div class="card-box bg-pattern">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="avatar-md bg-info rounded">
                                            <i class="fe-dollar-sign avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="text-right">
                                            <h5 class="text-dark my-1">@setting('currency_symbol') <span data-plugin="coun0terup">
                                                {{ number_format(($payments->sum('total_collected') - $payments->sum('company_deduction')),2) }}
                                            </span>
                                        </h5>
                                            <p class="text-muted mb-0 text-truncate">Total Paid To Landlords</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card-box-->
                        </div> <!-- end col -->
                    </div>
                    @endif

                   


                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Landlord Name</th>
                                    <th class="text-center">No Of Invoices</th>
                                    <th>Total Collected</th>
                                    <th>Company Deduction</th>
                                    <th>Net Income</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($payments as $payment)
                                <tr>
                                    <td class="font-weight-bold">
                                        {{ $payment->landlord->name ?? 'NO LANDLORD AVAILABLE'}}
                                    </td>
                                    <td class="font-weight-bold text-center">
                                        {{ $payment->no_of_invoices}}
                                    </td>
                                    <td class="font-weight-bold">
                                        @setting('currency_symbol') {{ number_format($payment->total_collected,2)}}
                                    </td>
                                    <td class="font-weight-bold">
                                        @setting('currency_symbol') {{ number_format($payment->company_deduction,2)}}
                                    </td>
                                    <td class="font-weight-bold">
                                        @setting('currency_symbol')
                                        {{ number_format($payment->total_collected-$payment->company_deduction,2)}}
                                    </td>
                                </tr>
                                @empty
                                <div class="mb-3">
                                    <div class="alert alert-info" role="alert">
                                        <i class="mdi mdi-alert-circle-outline mr-2"></i>
                                        No payment record is available for the month <strong> {{ $month }}</strong>
                                    </div>
                                </div>

                                @endforelse


                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>

    @push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous">
    </script>
    @endpush
</div>