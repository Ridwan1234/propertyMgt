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
                {{-- <h4 class="page-title">Application Settings</h4> --}}
            </div>
        </div>
    </div>
    <!-- end page title -->


    <!-- Form row -->
    <div class="row mt-4">
        <div class="col-lg-8 col-xl-8 mx-auto">
            <div class="card-box">
              
                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Set App Settings</h5>
                    
                    @livewire('admin.settings.manage')
                
            </div> <!-- end card-box-->

        </div>
    </div>
    <!-- end row -->


    <!-- end row-->

</div>

@endsection