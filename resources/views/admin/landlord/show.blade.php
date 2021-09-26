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
                            <a href="{{ route('admin.landlord.index')}}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left"></i> {{ __('landlord.Back to Landlords Listing') }} </a>
                        </form>
                    </div>
                    <h4 class="page-title">{{__('landlord.Landlord Details')}}</h4>
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
            <div class="col-lg-4 col-xl-4">
                <div class="card-box text-center">


                    <h4 class="mb-2">{{ $landlord->fname}}</h4>

                    @permission('landlord-update')

                    <a href="{{ route('admin.landlord.edit',$landlord->id)}}"
                       class="btn btn-success btn-xs waves-effect mb-2 waves-light">
                        Edit
                    </a>

                    @endpermission

                    @permission('landlord-delete')

                    <form action="{{ route('admin.landlord.destroy',$landlord->id)}}" style="display: inline;"
                          method="post">

                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this landlord ?')"
                                class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Delete
                        </button>
                    </form>

                    @endpermission

                    <div class="text-left mt-3">
                        <h4 class="font-13 text-uppercase">About Me :</h4>

                        <p class="text-muted mb-2 font-13"><strong>{{ __('tenant.Full Name') }} :</strong> <span
                                class="ml-2">{{ $landlord->fname . " " . $landlord->lname}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>{{ __('tenant.Phone Number') }} :</strong><span
                                class="ml-2">{{ $landlord->landlordProfile->phone ?? ''}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>{{ __('tenant.Email') }} :</strong> <span
                                class="ml-2 ">{{ $landlord->email}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>{{ __('tenant.Address') }} :</strong> <span
                                class="ml-2">{{ $landlord->landlordProfile->address}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong> {{ __('landlord.Bank Associated') }} :</strong>
                            <span
                                class="ml-2">{{ $landlord->landlordProfile->bank_name}}</span></p>
                        <p class="text-muted mb-1 font-13"><strong>{{ __('landlord.Bank Account No') }}:</strong> <span
                                class="ml-2">{{ $landlord->landlordProfile->bank_account}}</span></p>
                    </div>


                </div> <!-- end card-box -->
                @isset($landlord->landlordProfile->identity_document)
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
                                    <a href="{{ url($landlord->landlordProfile->identity_document)}}"
                                       class="text-muted font-weight-medium" target="_blank">
                                        {{ __('tenant.Identification Document') }}
                                    </a>
                                    {{-- <p class="mb-0 font-13">{{ \Illuminate\Support\Facades\Storage::size($landlord->landlordProfile->identity_document) }}
                                    </p> --}}
                                </div>


                            </div> <!-- end row -->
                        </div> <!-- end .p-2-->
                    </div>
                    <!-- end card-box-->

                @endisset

            </div> <!-- end col-->

            <div class="col-lg-8 col-xl-8">


                <div class="card-box">
                    <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                            <a href="#properties-b1" data-toggle="tab" aria-expanded="false"
                               class="font-weight-bold font-14 nav-link active">
                                {{__('landlord.Properties')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#earnings-b1" data-toggle="tab" aria-expanded="true"
                               class="font-weight-bold font-14 nav-link">
                                {{ __('landlord.Earnings') }}
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="properties-b1">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead class="">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('landlord.Property Name') }}</th>
                                        <th>{{ __('landlord.Type') }}</th>
                                        <th>{{ __('landlord.Units') }}</th>
                                        <th>{{ __('landlord.Status') }}</th>
                                        <th class="text-right">{{ __('landlord.View') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse ($landlord->properties as $property)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $property->title}}</td>
                                            <td>{{ $property->property_type}}</td>
                                            <td>{{ $property->propertyUnits->count()}}</td>
                                            <td>
                                                @switch($property->status)
                                                    @case('vacant')
                                                    <span
                                                        class="badge bg-danger text-white p-1">{{ __('landlord.VACANT') }}</span>
                                                    @break
                                                    @case('occupied')
                                                    <span
                                                        class="badge bg-success text-white  p-1">{{ __('landlord.OCCUPIED') }}</span>
                                                    @break
                                                    @case('unavailable')
                                                    <span
                                                        class="badge bg-secondary text-white p-1">{{ __('landlord.UNAVAILABLE') }}</span>
                                                    @break
                                                    @default

                                                @endswitch
                                            </td>
                                            <td class="text-right">
                                                <a href="javascript: void(0);"
                                                   class="btn btn-xs btn-primary waves-effect waves-light">
                                                    {{__('landlord.View')}}
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-warning" role="alert">
                                            <i class="mdi mdi-alert-outline mr-2"></i>
                                            {{__('landlord.No Associated properties for landlord')}}
                                            <strong>{{ $landlord->name }}</strong>
                                        </div>

                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane show" id="earnings-b1">
                            @livewire('admin.landlord.show-earnings', ['landlordId' => $landlord->id])
                        </div>

                    </div>
                </div>


            </div> <!-- end col -->
        </div>
        <!-- end row-->


        <!-- end row-->

    </div>

@endsection
