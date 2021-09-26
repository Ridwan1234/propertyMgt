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
                                <i class="mdi mdi-arrow-left"></i> {{ __('landlord.Back to Landlords Listing') }}</a>
                        </form>
                    </div>
                    <h4 class="page-title">{{ __('landlord.Update Landlord') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <!-- Form row -->
        @livewire('admin.landlord.edit',['landlordId'=>$id])
        <!-- end row -->


        <!-- end row-->

    </div>

@endsection
