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
                            <a href="{{ route('admin.tenant.index')}}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left"></i> {{ __('tenant.Back to Tenants') }} </a>
                        </form>
                    </div>

                    <h4 class="page-title">{{__('tenant.Tenant Details')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @if (session()->has('success'))

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>

        @endif

        <div class="row">


            <div class="col-md-4 col-md-4">
                <div class="card-box text-center">


                    <h4 class="mb-2">{{ $tenant->fname}}</h4>


                    @permission('tenant-update')
                    <a href="{{ route('admin.tenant.edit',$tenant->id)}}"
                       class="btn btn-success btn-xs waves-effect mb-2 waves-light">
                        Edit
                    </a>
                    @endpermission

                    @permission('tenant-delete')

                    <form action="{{ route('admin.tenant.destroy',$tenant->id)}}" style="display: inline;"
                          method="post">

                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this tenant ? If you wish to proceed,first make sure you have terminated all active leases that this tenant has.')"
                                class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Delete
                        </button>
                    </form>

                    @endpermission


                    <div class="text-left mt-3">
                        <h4 class="font-13 text-uppercase">About Me :</h4>

                        <p class="text-muted mb-2 font-13"><strong>{{ __('tenant.Full Name') }} :</strong> <span
                                class="ml-2">{{ $tenant->fname . " " .$tenant->lname}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>{{ __('tenant.Phone Number') }} :</strong><span
                                class="ml-2">{{ $tenant->tenantProfile->phone ?? ''}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>{{ __('tenant.Email') }} :</strong> <span
                                class="ml-2 ">{{ $tenant->email}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>{{ __('tenant.Address') }} :</strong>
                            <span class="ml-2">{{ $tenant->tenantProfile->address}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>{{ __('tenant.Occupation Status') }}:</strong>
                            <span class="ml-2">{{ $tenant->tenantProfile->occupation_status}} </span>
                        </p>
                        <p class="text-muted mb-2 font-13"><strong>{{ __('tenant.Occupation Place') }}:</strong>
                            <span class="ml-2">{{ $tenant->tenantProfile->occupation_details}} </span>
                        </p>
                        <p class="text-muted mb-2 font-13"><strong>Emergency Contact Person:</strong>
                            <span class="ml-2">{{ $tenant->tenantProfile->emergency_contact_person}} </span>
                        </p>
                        <p class="text-muted mb-2 font-13"><strong>Emergency Contact Phone:</strong>
                            <span class="ml-2">{{ $tenant->tenantProfile->emergency_contact_number}} </span>
                        </p>
                        <p class="text-muted mb-2 font-13"><strong>Emergency Contact Phone:</strong>
                            <span class="ml-2">{{ $tenant->tenantProfile->emergency_contact_number}} </span>
                        </p>
                    </div>


                </div> <!-- end card-box -->
                @isset($tenant->tenantProfile->identity_document)
                    <div class="card border">
                        <div class="p-2">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-sm">
                                <span class="avatar-title bg-light text-secondary rounded">
                                    <i class="mdi mdi-folder-account font-18"></i>
                                </span>
                                    </div>
                                </div>


                                <div class="col pl-0">
                                    <a href="{{ url($tenant->tenantProfile->identity_document)}}"
                                       class="text-muted font-weight-medium" target="_blank">
                                        {{ __('tenant.Identification Document') }}
                                    </a>
                                    {{-- <p class="mb-0 font-13">{{ \Illuminate\Support\Facades\Storage::size($tenant->tenantProfile->identity_document) }}
                                    </p> --}}
                                </div>


                            </div> <!-- end row -->
                        </div> <!-- end .p-2-->
                    </div>
                    <!-- end card-box-->

                @endisset

            </div> <!-- end col-->

            <div class="col-md-8 col-md-8">


                <div class="card-box">
                    <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                            <a href="#tenancy-b1" data-toggle="tab" aria-expanded="false"
                               class="font-weight-bold font-14 nav-link active">
                                {{__('tenant.Leases')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#invoices-b1" data-toggle="tab" aria-expanded="true"
                               class="font-weight-bold font-14 nav-link">
                                {{__('tenant.Invoices')}}
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tenancy-b1">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Leased</th>
                                        <th>Type</th>
                                        <th>Start Date</th>
                                        <th>Expires On</th>
                                        <th class="text-center">View</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse ($tenant->leases as $lease)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td> {{ $lease->leasable->title }}</td>
                                            <td> {{ $lease->type }}</td>
                                            <td> {{ \Carbon\Carbon::parse($lease->start_date)->format('d M Y') }}</td>
                                            <td> {{ \Carbon\Carbon::parse($lease->end_date)->format('d M Y') }} </td>
                                            <td class="text-right">
                                                <a href="{{ route('admin.lease.show',$lease->id)}}"
                                                   class="btn btn-xs btn-primary waves-effect waves-light">
                                                    {{ __('tenant.Details') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-warning" role="alert">
                                            <i class="mdi mdi-alert-outline mr-2"></i>
                                            {{__('tenant.No Associated leases for tenant')}}
                                            <strong>{{ $tenant->name }}</strong>
                                        </div>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane show" id="invoices-b1">
                            @livewire('admin.tenant.show-invoices', ['tenantId' => $tenant->id])
                        </div>

                    </div>
                </div>


            </div> <!-- end col -->
        </div>
        <!-- end row-->


        <!-- end row-->

    </div>

@endsection
