@extends('layout.user')

@section('content')

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                 
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <x-user-tickets />

    @role('landlord')

    <x-landlord-properties />
    @endrole

    
    @role('tenant')

    <x-user-widget-component />
    @endrole
    <!-- end row-->

    


</div>

@endsection