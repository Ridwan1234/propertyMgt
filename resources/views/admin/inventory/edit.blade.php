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
                        <a href="{{ route('admin.inventory.index')}}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Back to Inventories </a>
                    </form>
                </div>
                <h4 class="page-title">Create Inventory</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <!-- Form row -->
    @livewire('admin.inventory.edit', ['inventoryId' => $id])
    <!-- end row -->


    <!-- end row-->

</div>

@endsection