@extends('layout.user')




@push('header-css')

<!-- Lightbox css -->
<link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
<style>
    /* Set the size of the div element that contains the map */
    #map {
        height: 420px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
    }
</style>
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

                        <a href="{{ route('user.property.index')}}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Back to My Properties </a>

                    </form>
                </div>
                <h4 class="page-title">Property Details</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <!-- Form row -->
    <div class="row">
        <div class="col-xl-12">
            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class='mdi mdi-dots-horizontal font-18'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class='mdi mdi-attachment mr-1'></i>Attachment
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class='mdi mdi-pencil-outline mr-1'></i>Edit
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class='mdi mdi-content-copy mr-1'></i>Mark as Duplicate
                            </a>
                            <div class="dropdown-divider"></div>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item text-danger">
                                <i class='mdi mdi-delete-outline mr-1'></i>Delete
                            </a>
                        </div> <!-- end dropdown menu-->
                    </div> <!-- end dropdown-->
                    <h4>{{ $property->title }}</h4>
                    <!-- end custom-checkbox-->
                    <div class="clearfix mb-4"></div>


                    <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                            <a href="#overview" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#amenities" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Features & Amenities
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#gallery" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                Gallery
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#units" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                Units
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#ownership" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                Ownership
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#location" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                Location
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <!-- Overview tab -->
                        <div class="tab-pane active" id="overview">
                            <div class="row">
                                <div class="col-md-4">
                                    <!-- assignee -->
                                    <p class="mt-2 mb-0 text-muted">Property Type</p>
                                    <div class="media">
                                        <div class="media-body">
                                            <h5 class="mt-1 font-size-14">
                                                {{ $property->property_type}}
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- end assignee -->
                                </div> <!-- end col -->

                                <div class="col-md-4">
                                    <!-- start due date -->
                                    <p class="mt-2 mb-0 text-muted">Area</p>
                                    <div class="media">
                                        <div class="media-body">
                                            <h5 class="mt-1 font-size-14">
                                                {{ $property->area }} Sqmt
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- end due date -->
                                </div>

                                <div class="col-md-4">
                                    <!-- start due date -->
                                    <p class="mt-2 mb-0 text-muted">Status</p>
                                    <div class="media">
                                        <div class="media-body">
                                            <h5 class="mt-1 font-size-14">
                                                {{ $property->status }}
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- end due date -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div class="row">
                                <div class="col-md-4">
                                    <!-- assignee -->
                                    <p class="mt-2 mb-0 text-muted">Agency Commission</p>
                                    <div class="media">
                                        <div class="media-body">
                                            <h5 class="mt-1 font-size-14">
                                                {{ $property->commission}} %
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- end assignee -->
                                </div> <!-- end col -->

                                <div class="col-md-4">
                                    <!-- start due date -->
                                    <p class="mt-2 mb-0 text-muted">Rent</p>
                                    <div class="media">
                                        <div class="media-body">
                                            <h5 class="mt-1 font-size-14">
                                                @setting('currency_symbol') {{ number_format($property->rent,2)}}
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- end due date -->
                                </div>

                                <div class="col-md-4">
                                    <!-- start due date -->
                                    <p class="mt-2 mb-0 text-muted">Deposit</p>
                                    <div class="media">
                                        <div class="media-body">
                                            <h5 class="mt-1 font-size-14">
                                                @setting('currency_symbol') {{ number_format($property->deposit,2)}}
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- end due date -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <h5 class="mt-3">Description:</h5>

                            <p class="text-muted mb-4">
                                {{ $property->description}}
                            </p>
                        </div>
                        <!-- End Overview tab -->

                        <!-- Amenities tab -->
                        <div class="tab-pane " id="amenities">
                            <div class="p-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- assignee -->
                                        <p class="mt-2 mb-0 text-muted">Rooms</p>
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="mt-1 font-size-14">
                                                    {{ $property->rooms}}
                                                </h5>
                                            </div>
                                        </div>
                                        <!-- end assignee -->
                                    </div> <!-- end col -->

                                    <div class="col-md-3">
                                        <!-- start due date -->
                                        <p class="mt-2 mb-0 text-muted">Bedrooms</p>
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="mt-1 font-size-14">
                                                    {{ $property->bedrooms }}
                                                </h5>
                                            </div>
                                        </div>
                                        <!-- end due date -->
                                    </div>

                                    <div class="col-md-3">
                                        <!-- start due date -->
                                        <p class="mt-2 mb-0 text-muted">Bathrooms</p>
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="mt-1 font-size-14">
                                                    {{ $property->bathrooms }}
                                                </h5>
                                            </div>
                                        </div>
                                        <!-- end due date -->
                                    </div>

                                    <div class="col-md-3">
                                        <!-- start due date -->
                                        <p class="mt-2 mb-0 text-muted">Age</p>
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="mt-1 font-size-14">
                                                    {{ $property->age }}
                                                </h5>
                                            </div>
                                        </div>
                                        <!-- end due date -->
                                    </div>


                                    <!-- end col -->
                                </div> <!-- end row -->

                                <h5 class="mt-3">Property Notes:</h5>

                                <p class="text-muted mb-4">
                                    {{ $property->notes}}
                                </p>


                                <h5 class="mt-3">Features:</h5>
                                <div class="row mb-3">
                                    @if ($property->amenities)
                                    @foreach ($property->amenities as $item)
                                    <div class="col-md-4">
                                        <p class="text-muted">
                                            <i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary mr-2"></i>
                                            {{ $item }}
                                        </p>
                                    </div>
                                    @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                        <!-- End Amenities tab -->

                        <!-- Gallery tab -->
                        <div class="tab-pane " id="gallery">
                            <div class="row p-2">




                                @forelse ($property->galleries as $item)
                                <div class="col-4 ">
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
                        <!-- End Gallery tab -->


                        <!-- Units tab -->
                        <div class="tab-pane " id="units">

                            <div class="p-1">
                               @livewire('admin.property.show-property-units', ['propertyId' => $property->id])
                            </div>



                        </div>
                        <!-- End Units tab -->

                        
                        <!-- Location tab -->
                        <div class="tab-pane " id="location">
                            <div class="p-1">
                                <!--The div element for the map -->
                                <div id="map"></div>
                            </div>

                            <input type="hidden" name="" id="longitude" value="{{ $property->longitude }}">
                            <input type="hidden" name="" id="latitude" value="{{ $property->latitude }}">
                            <input type="hidden" name="" id="title" value="{{ $property->title }}">
                        </div>
                        <!-- End Location tab -->

                    </div>

                </div> <!-- end card-body-->

            </div> <!-- end card-->


        </div> <!-- end col -->


    </div>
    <!-- end row -->
    <!-- end row-->

    <!-- end row -->


    <!-- end row-->

</div>

@endsection

@push('footer-scripts')
<script>
    //get lat and long
        var long = document.getElementById('longitude').value;
        var lat = document.getElementById('latitude').value;
        var propertyTitle = document.getElementById('title').value;

        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            var paris = {lat: parseFloat(lat), lng: parseFloat(long)};

            //Position of paris

            // var paris={ lat: 48.865671,lng:2.329768}

            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 11, center: paris});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker(
                {
                    position: paris,
                    zoom: 13,
                    animation: google.maps.Animation.DROP,
                    map: map,
                    title: propertyTitle
                });

            // To add the marker to the map, call setMap();
            marker.setMap(map);

            var infowindow = new google.maps.InfoWindow({
               content:propertyTitle
            });
				
            

            marker.addListener("click", () => {
    infowindow.open(map, marker);
    //toggleBounce();
  });

            // marker.addListener("click", toggleBounce);

            function toggleBounce() {
                if (marker.getAnimation() !== null) {
                    marker.setAnimation(null);
                } else {
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                }
            }
        }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&callback=initMap">
</script>

<!-- Magnific Popup-->
<script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

<!-- Gallery Init-->
<script src="{{ asset('assets/js/pages/gallery.init.js')}}"></script>
@endpush