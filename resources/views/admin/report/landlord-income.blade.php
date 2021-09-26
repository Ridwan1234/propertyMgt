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
                <h4 class="page-title">Landlord Payments</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <!-- Form row -->
  @livewire('admin.report.landlord-payments')
    <!-- end row -->


    <!-- end row-->

</div>

@endsection