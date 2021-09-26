@extends('layout.main')

@push('header-css')

    <!-- Lightbox css -->
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css"/>
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

                            <a href="{{ route('admin.property-unit.index')}}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left"></i> {{ __('unit.Back to Units') }} </a>

                        </form>
                    </div>
                    <h4 class="page-title">{{ __('unit.Unit Details') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <!-- Form row -->
        <div class="row">

            @if (session()->has('success'))
                <div class="col-12 mb-2">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

            @endif

            <div class="col-12">
                <div class="card-box p-0 m-0">
                    <div class="row">


                        <div class="col-sm-5">
                            <div class="p-3">
                                <h5 class="card-title font-16 mb-3">{{ __('unit.Property Unit Details') }}</h5>
                                <table
                                    class="table table-sm table-borderless text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                                    <tbody>
                                    <tr>
                                        <td>{{ __('unit.Unit Title') }}</td>
                                        <td class="font-weight-semibold">
                                            {{ $unit->title}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('unit.Parent Property') }}</td>
                                        <td class="font-weight-semibold">
                                            <a
                                                href="{{ route('admin.property.show',$unit->property->id)}}">{{ $unit->property->title}}</a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Caution') }}</td>
                                        <td class="font-weight-semibold">
                                            @setting('currency_symbol') {{ number_format($unit->caution, 2)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('unit.Monthly Rent') }}</td>
                                        <td class="font-weight-semibold">
                                            @setting('currency_symbol') {{ number_format($unit->rent,2)}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Service Charge') }}</td>
                                        <td class="font-weight-bold">
                                            @setting('currency_symbol') {{ number_format($unit->service, 2) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('unit.Status') }}</td>
                                        <td class="font-weight-semibold">
                                            @switch($unit->status)
                                                @case('vacant')
                                                <span class="badge bg-danger text-white p-1">VACANT</span>
                                                @break
                                                @case('occupied')
                                                <span class="badge bg-success text-white  p-1">OCCUPIED</span>
                                                @break
                                                @case('unavailable')
                                                <span class="badge bg-secondary text-white p-1">UNAVAILABLE</span>
                                                @break
                                                @default

                                            @endswitch


                                        </td>
                                    </tr>


                                    </tbody>
                                </table>
                                <h5 class="card-title font-16 mb-3">{{ __('unit.Description / Amenities') }}</h5>
                                <p class="text-muted mb-3">
                                    {{ $unit->description }}
                                </p>

                                <div class="p-2 text-center">

                                    @permission('unit-update')
                                    <a href="{{ route('admin.property-unit.edit',$unit->id)}}"
                                       class="btn btn-success btn-xs waves-effect mb-2 waves-light">
                                        Edit
                                    </a>

                                    @endpermission

                                    @permission('unit-delete')


                                    <form action="{{ route('admin.property-unit.destroy',$unit->id)}}"
                                          style="display: inline;" method="post">

                                        @method('DELETE')
                                        @csrf

                                        <button type="submit" onclick="return confirm('Delete this lease ?')"
                                                class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Delete
                                        </button>
                                    </form>

                                    @endpermission


                                </div>

                            </div>
                        </div>
                        <div class="col-sm-7" style="border-left: 5px solid #f5f5f5;">
                            <div class="p-3">
                                <ul class="nav nav-pills navtab-bg nav-justified">
                                    <li class="nav-item">
                                        <a href="#home1" data-toggle="tab" aria-expanded="false"
                                           class="nav-link active">
                                            {{ __('unit.Gallery') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link">
                                            {{ __('unit.Map Location') }}
                                        </a>
                                    </li>
                                </ul>


                                <div class="tab-content">
                                    <div class="tab-pane active" id="home1">
                                        <div class="row p-2">
                                            @forelse ($unit->galleries as $item)
                                                <div class="col-4 ">
                                                    <div class="gal-box">
                                                        <a href="{{ url($item->image)}}" class="image-popup"
                                                           title="Screenshot-1">
                                                            <img src="{{ url($item->image)}}" class="img-fluid"
                                                                 alt="work-thumbnail">
                                                        </a>
                                                    </div> <!-- end gal-box -->
                                                </div>
                                            @empty
                                                <div class="col-12">
                                                    <div class="alert alert-warning" role="alert">
                                                        <i class="mdi mdi-alert-outline mr-2"></i>
                                                        {{ __('unit.No images uploaded for this property unit') }}
                                                    </div>
                                                </div>

                                            @endforelse

                                        </div>
                                    </div>
                                    <div class="tab-pane show" id="profile1">
                                        <div class="p-1">
                                            <!--The div element for the map -->
                                            <div id="map"></div>
                                        </div>

                                        <input type="hidden" name="" id="longitude"
                                               value="{{ $unit->property->longitude }}">
                                        <input type="hidden" name="" id="latitude"
                                               value="{{ $unit->property->latitude }}">
                                        <input type="hidden" name="" id="title"
                                               value="Property :{{ $unit->property->title }} <br> Unit: {{ $unit->title }}">
                                    </div>

                                </div>

                            </div>
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
                content: propertyTitle
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

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&callback=initMap">
    </script>

    <!-- Magnific Popup-->
    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <!-- Gallery Init-->
    <script src="{{ asset('assets/js/pages/gallery.init.js')}}"></script>
@endpush
