@extends('layout.main')



@push('header-css')

<!-- Lightbox css -->
<link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
@endpush

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
                <h4 class="page-title">Show Inventory</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <!-- Form row -->
    <div class="row">

        @if (session()->has('success'))
        <div class="col-12 mb-1">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
        <div class="col-xl-12">
            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <!-- assignee -->
                            <p class="mt-2 mb-0 text-muted">Inventory For :</p>
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-1 font-size-14">
                                        {{ $inventory->inventorable->title}}
                                    </h5>
                                </div>
                            </div>
                            <!-- end assignee -->
                        </div> <!-- end col -->

                        <div class="col-md-6">
                            <!-- start due date -->
                            <p class="mt-2 mb-0 text-muted">Type </p>
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-1 font-size-14">
                                        {{$inventory->type}}
                                    </h5>
                                </div>
                            </div>
                            <!-- end due date -->
                        </div>


                    </div>

                    <h5 class="mt-3">Description:</h5>

                    <p class="text-muted mb-4">
                        {{ $inventory->description}}
                    </p>

                    <h5 class="mt-3">Images:</h5>

                    <div class="row">
                        @forelse ($inventory->images as $item)
                        <div class="col-3 ">
                            <div class="gal-box">
                                <a href="{{ url($item->image)}}" class="image-popup" title="Screenshot-1">
                                    <img src="{{ url($item->image)}}" class="img-fluid" alt="work-thumbnail">
                                </a>
                            </div> <!-- end gal-box -->
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-warning" role="alert">
                                <i class="mdi mdi-alert-outline mr-2"></i> No images uploaded for this property
                            </div>
                        </div>

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->


    <!-- end row-->

</div>

@endsection


@push('footer-scripts')
<!-- Magnific Popup-->
<script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

<!-- Gallery Init-->
<script src="{{ asset('assets/js/pages/gallery.init.js')}}"></script>
@endpush