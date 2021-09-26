@extends('layout.main')

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">


            @if (session()->has('success'))
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif


            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="form-inline">

                            <a href="{{ route('admin.lease.index')}}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left"></i> {{ __('lease.Back to Leases Listing') }} </a>

                        </form>
                    </div>
                    <h4 class="page-title">{{ __('lease.Lease Details') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <!-- Form row -->
        <div class="row">

            <div class="col-12">
                <div class="card-box">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown"
                           aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" style="">

                            @permission('lease-update')
                            <!-- item-->
                            <a href="{{ route('admin.lease.edit',$lease->id)}}" class="dropdown-item">
                                {{ __('lease.Edit Lease') }}
                            </a>
                            <!-- item-->
                            @endpermission

                            @permission('lease-delete')

                            <a href="javascript:void(0);" class="dropdown-item" onclick="
                        var yes=confirm('Delete this lease ?');

                        if(yes){
                            event.preventDefault();
                                         document.getElementById('delete-form').submit();
                        }
                       ">
                                {{ __('lease.Delete Lease') }}
                            </a>


                            <form action="{{ route('admin.lease.destroy',$lease->id)}}" id="delete-form" class="d-none"
                                  method="post">

                                @method('DELETE')
                                @csrf
                            </form>

                            @endpermission


                        </div>
                    </div>
                    <h4 class="header-title mb-4">{{ __('lease.Lease Details') }}</h4>

                    <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                            <a href="#details-b1" data-toggle="tab" aria-expanded="false"
                               class="font-weight-semibold nav-link active">
                                {{ __('lease.Lease Details') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#bills-b1" data-toggle="tab" aria-expanded="true"
                               class="font-weight-semibold nav-link">
                                {{ __('lease.Lease Included Bills') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#documents-b1" data-toggle="tab" aria-expanded="false"
                               class="font-weight-semibold nav-link ">
                                {{ __('lease.Lease Documents') }}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="details-b1">
                            <div class="p-2">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="p-3">
                                            <h5 class="card-title font-16 mb-3">{{ __('lease.Lease Details') }}</h5>
                                            <table
                                                class="table table-sm table-borderless text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                                                <tbody>
                                                <tr>
                                                    <td>{{ __('lease.Tenant Name') }}</td>
                                                    <td class="font-weight-semibold">
                                                        {{ $lease->tenant->name ?? 'Deleted tenant'}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('lease.Property Leased') }}</td>
                                                    <td class="font-weight-semibold">
                                                        {{ $lease->leasable->title}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('lease.Type') }}</td>
                                                    <td class="font-weight-semibold">
                                                        {{ $lease->type}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('lease.Monthly Rent') }}</td>
                                                    <td class="font-weight-semibold">
                                                        @setting('currency_symbol')
                                                        {{ number_format($lease->leasable->rent,2)}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>{{ __('lease.Deposit Paid') }}</td>
                                                    <td class="font-weight-semibold">
                                                        @setting('currency_symbol')
                                                        {{ number_format($lease->deposit,2)}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>{{ __('lease.Lease Start Date') }}</td>
                                                    <td class="font-weight-semibold">
                                                        {{ \Carbon\Carbon::parse($lease->start_date)->format('M d, Y')  }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('lease.Lease End Date') }}</td>
                                                    <td class="font-weight-semibold">
                                                        {{ \Carbon\Carbon::parse($lease->end_date)->format('M d, Y')  }}

                                                    </td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="border-left: 5px solid #f5f5f5;">
                                        <div class="p-3">
                                            <h5 class="card-title font-16 mb-3">{{ __('lease.Tenancy Terms') }}</h5>
                                            <p class="text-muted mb-3">
                                                {{ $lease->terms }}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane show" id="bills-b1">
                            @livewire('admin.lease.lease-bills', ['leaseId' => $lease->id])
                        </div>
                        <div class="tab-pane " id="documents-b1">

                            @livewire('admin.lease.lease-documents', ['leaseId' => $lease->id])
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->

        <!-- Bills modal content -->
        <div id="bill-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="bill-modalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="upload-modalLabel">{{ __('lease.Add New Included Bill') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    @livewire('admin.lease.add-lease-bill', ['leaseId' => $lease->id])


                </div>
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


        <!-- Standard modal content -->
        <div id="upload-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="upload-modalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="upload-modalLabel">{{ __('lease.Upload Document') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    @livewire('admin.lease.upload-lease-document', ['leaseId' => $lease->id])


                </div>
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


        <!-- end row-->

    </div>

    @push('footer-scripts')
        <script>
            $(function () {

                Livewire.on('closeUploadModal', function () {
                    $('#upload-modal').modal('hide')

                })
                Livewire.on('closeBillModal', function () {
                    $('#bill-modal').modal('hide')

                })

            });
        </script>

    @endpush

@endsection
