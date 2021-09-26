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
                        <a href="{{ route('admin.tenant.index')}}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> {{__('tenant.Back to Tenants')}} </a>
                    </form>
                </div>
                <h4 class="page-title">{{__('tenant.Edit Tenant')}}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    @livewire('admin.tenant.edit', ['tenantId' => $id])
    <!-- end row -->


    <!-- end row-->

</div>

@endsection
