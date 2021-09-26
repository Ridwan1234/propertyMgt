@extends('layout.main')

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{ __('property.Update Property') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <!-- Form row -->
        @livewire('admin.property.edit',['propertyId'=>$id])
        <!-- end row -->


        <!-- end row-->

    </div>

@endsection
