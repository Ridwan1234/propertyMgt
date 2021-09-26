@extends('layout.main')

@section('content')

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('unit.Add Property Units') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <!-- Form row -->
    @livewire('admin.property-unit.create')
    <!-- end row -->


    <!-- end row-->

</div>

@endsection
