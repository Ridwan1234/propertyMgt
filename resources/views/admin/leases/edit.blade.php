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
                            <a href="{{ route('admin.lease.index')}}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left"></i> {{ __('lease.Back to Leases Listing') }} </a>
                        </form>
                    </div>
                    <h4 class="page-title">{{ __('lease.Update Lease') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <!-- Form row -->
        @livewire('admin.lease.update-lease',['leaseId'=>$id])

        <!-- end row -->


        <!-- end row-->

    </div>

@endsection
