@extends('layout.main')

@section('content')

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">

                </div>
                <h4 class="page-title">{{\App\Helpers\Greeting::greeting() }} {{ auth()->user()->name }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <x-admin-dashboard-widget />

    <!-- end row-->


</div>

@endsection
