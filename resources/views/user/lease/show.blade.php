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

                        <a href="{{ route('user.lease.index')}}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Back to Leases </a>

                    </form>
                </div>
                <h4 class="page-title">Lease Details</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <!-- Form row -->
    <div class="row">

        <div class="col-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="p-3">
                            <h5 class="card-title font-16 mb-3">Lease Details</h5>
                            <table
                                class="table table-sm table-borderless text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                                <tbody>
                                    <tr>
                                        <td>Tenant Name</td>
                                        <td class="font-weight-semibold">
                                            {{ $lease->tenant->name ?? 'Deleted tenant'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Property Leased</td>
                                        <td class="font-weight-semibold">
                                            {{ $lease->leasable->title}}</td>
                                    </tr>
                                    <tr>
                                        <td>Type</td>
                                        <td class="font-weight-semibold">
                                            {{ $lease->type}}</td>
                                    </tr>
                                    <tr>
                                        <td>Monthly Rent</td>
                                        <td class="font-weight-semibold">
                                            @setting('currency_symbol')
                                            {{ number_format($lease->leasable->rent,2)}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Deposit Paid</td>
                                        <td class="font-weight-semibold">
                                            @setting('currency_symbol')
                                            {{ number_format($lease->deposit,2)}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Lease Start Date</td>
                                        <td class="font-weight-semibold">
                                            {{ \Carbon\Carbon::parse($lease->start_date)->format('M d, Y')  }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lease End Date</td>
                                        <td class="font-weight-semibold">
                                            {{ \Carbon\Carbon::parse($lease->end_date)->format('M d, Y')  }}

                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                            

                            <h5 class="card-title font-16 mb-3">Lease Bills</h5>

                            <div class="table-responsive">
                                <table class="table table-sm table-borderless table-nowrap table-hover table-centered m-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Bill Name</th>
                                            <th>Amount Payable Monthly</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($lease->bills as $item)
                                        <tr>
                                            <td class="font-weight-bold">
                                                {{ $loop->iteration}}
                                            </td>

                                            <td class="font-weight-bold">
                                                {{ Str::upper($item->name)}}
                                            </td>

                                            <td class="font-weight-bold text-center">
                                               @setting('currency_symbol') {{ number_format($item->amount,2)}}
                                            </td>


                                        </tr>
                                        @empty
                                        <div class="alert alert-success" role="alert">
                                            <i class="mdi mdi-check-all mr-2"></i> No bills are included in this lease
                                        </div>
                                        @endforelse



                                    </tbody>
                                </table>
                            </div>



                        </div>
                    </div>
                    <div class="col-sm-6" style="border-left: 5px solid #f5f5f5;">
                        <div class="p-3">
                            <h5 class="card-title font-16 mb-3">Tenancy Terms</h5>
                            <p class="text-muted mb-3">
                                {{ $lease->terms }}
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->




    <!-- end row-->

</div>




@endsection