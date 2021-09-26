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

                        <a href="javascript: void(0);" class="btn btn-blue btn-sm ml-1">
                            <i class="mdi mdi-filter-variant"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">{{__('landlord.Register Landlord')}}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <!-- Form row -->
    @livewire('admin.landlord.create')
    <!-- end row -->


    <!-- end row-->

</div>

@endsection
