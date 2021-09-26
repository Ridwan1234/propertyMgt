<div>

    @push('header-css')
        <style>
            .img-wrap {
                position: relative;
                display: inline-block;
                font-size: 0;
            }

            .img-wrap .close {
                position: absolute;
                top: 2px;
                right: 2px;
                z-index: 100;
                background-color: #FFF;
                padding: 5px 2px 2px;
                color: #000;
                font-weight: bold;
                cursor: pointer;
                opacity: .2;
                text-align: center;
                font-size: 22px;
                line-height: 10px;
                border-radius: 50%;
            }

            .img-wrap:hover .close {
                opacity: 1;
            }
        </style>

    @endpush


    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title ">{{ __('property.Create New Property') }}</h4>
                <p class="text-muted mb-4">
                    {{ __('property.Fill all required details in all sections before submitting the data.') }}
                </p>

                <ul class="nav nav-pills navtab-bg nav-justified bg-light">
                    <li class="nav-item">
                        <a href="#details" data-toggle="tab" aria-expanded="true" wire:ignore class="nav-link active">
                            {{ __('property.Basic Details') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#location" data-toggle="tab" aria-expanded="false" wire:ignore class="nav-link">
                            {{ __('property.Location') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#features" data-toggle="tab" aria-expanded="false" wire:ignore class="nav-link">
                            {{ __('property.Features & Amenities') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#images" data-toggle="tab" aria-expanded="false" wire:ignore class="nav-link">
                            {{ __('property.Property Images') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="details" wire:ignore.self>
                        <div class="mx-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="firstname">{{ __('property.Property Name') }} <span
                                                class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" wire:model.defer="title">
                                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="firstname">{{ __('property.Type') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="example-select" wire:model="propertyType">
                                            <option value="Mansion">Mansion</option>
                                            <option value="Villa">Villa</option>
                                            <option value="Bungalow">Bungalow</option>
                                            <option value="Apartment">Block of Apartment</option>
                                            <option value="Flat">Block of Flat</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="lastname">{{ __('property.Rent') }} <span
                                                class="text-danger">*</span> </label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                      id="basic-addon1">@setting('currency_symbol')</span>
                                            </div>
                                            <input type="number" min="0.0" class="form-control" aria-label="rent"
                                                   aria-describedby="basic-addon1" wire:model.defer="rent">


                                        </div>
                                        @error('rent') <span class="text-danger">{{ $message }}</span> @enderror

                                    </div>
                                </div>
                                <!-- end col -->
                            </div> <!-- end row -->
                            <div class="row">

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="lastname">{{ __('property.Select Landlord') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="example-select" wire:model="landlord">
                                            <option label="Select landlord "></option>

                                            @forelse ($landlords as $item=>$id)
                                                <option class="font-weight-medium" value="{{ $id}}">{{$item}}</option>
                                            @empty

                                            @endforelse

                                        </select>
                                        @error('landlord') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="firstname">{{ __('property.Area') }} </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Sqmt</span>
                                            </div>
                                            <input type="number" min="0.0" class="form-control" aria-label="Commission"
                                                   aria-describedby="basic-addon1" wire:model.defer="propertyArea">

                                        </div>
                                        @error('propertyArea') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="tx-medium">{{ __('property.Property Age (optional)') }}</label>
                                        <select class="tx-semibold form-control" wire:model="propertyAge">
                                            <option label="Select one"></option>
                                            <option value="0 - 5 YEARS">0 - 5 Years</option>
                                            <option value="5 - 10 YEARS">5 - 10 Years</option>
                                            <option value="10 - 15 YEARS">10 - 15 Years</option>
                                            <option value="15 - 20 YEARS">15 - 20 Years</option>
                                            <option value="20+ YEARS">20+ Years</option>
                                        </select>
                                    </div>
                                </div>
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="userbio">{{ __('property.Description') }} <span class="text-danger">*</span></label>
                                        <textarea wire:model.defer="description" class="form-control" id="userbio"
                                                  rows="4" placeholder="Property Description"></textarea>
                                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div> <!-- end col -->
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse mt-3 align-items-start">
                        <a href="#location" data-toggle="tab" aria-expanded="false">
                            <button type="button" class="btn btn-primary">NEXT</button>
                        </a>
                        </div>
                    </div>
                    <div class="tab-pane" id="location" wire:ignore.self>
                        <div class="mx-3">
                            <div class="form-group">
                                <label class="col-form-label">{{ __('property.Search location') }}</label>
                                <input type="text" wire:ignore.self id="autocomplete" onFocus="initAutocomplete()"
                                       class="form-control" placeholder="Type to search for location">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress2" class="col-form-label">{{ __('property.Address') }} </label>
                                <input type="text" class="form-control" id="custom_address"
                                       wire:model.defer="street_address">
                                <span class="form-text text-muted">
                                    <small>Longitude: <strong>{{ $longitude }}</strong> Latitude :
                                        <strong>{{ $latitude}}</strong></small>
                                </span>

                                {{-- <span class="form-text text-muted">
                                    <small>Longitude: <strong>{{ 53.2734 }}</strong> Latitude :
                                        <strong>{{ -7.77832031}}</strong></small>
                                </span> --}}

                                @error('longitude') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('latitude') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('street_address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">{{ __('property.City') }}</label>
                                    <input type="text" class="form-control" id="locality" wire:model.defer="city">
                                    @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-form-label">{{ __('property.State') }}</label>
                                    <input type="text" class="form-control" id="administrative_area_level_1"
                                           wire:model.defer="state">
                                    @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="col-form-label">{{ __('property.Post Code') }}</label>
                                    <input type="text" class="form-control" id="postal_code" wire:model.defer="zip">
                                    @error('zip') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <input wire:ignore.self id="country" disabled="true" hidden/>
                            <input wire:ignore.self id="street_number" disabled="true" hidden/>
                            <input wire:ignore.self id="route" disabled="true" hidden/>
                            <input hidden id="address_longitude"/>
                            <input hidden id="address_latitude"/>
                        </div>

                        <div class="d-flex flex-row-reverse mt-3 align-items-start float-left">
                          <a href="#details" data-toggle="tab" aria-expanded="false">
                              <button type="button" class="btn btn-primary">PREV</button>
                          </a>
                        </div>
                        <div class="d-flex flex-row-reverse mt-3 align-items-start">
                        <a href="#features" data-toggle="tab" aria-expanded="false">
                            <button type="button" class="btn btn-primary">NEXT</button>
                        </a>
                        </div>

                    </div>
                    <div class="tab-pane" id="features" wire:ignore.self>
                        <div class="mx-3">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="tx-medium">{{ __('property.Property Notes:') }}</label>
                                        <textarea class=" form-control" rows="3" wire:model="propertyNotes"></textarea>

                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox">
                                        <input value="Air Conditioner" type="checkbox" class="custom-control-input"
                                               id="customCheck1" wire:model.defer="amenities">
                                        <label class="custom-control-label" for="customCheck1">Air Conditioner</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox">
                                        <input value="Heating" type="checkbox" class="custom-control-input"
                                               id="customCheck2" wire:model.defer="amenities">
                                        <label class="custom-control-label" for="customCheck2">Heating</label>
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox">
                                        <input value="Internet" type="checkbox" class="custom-control-input"
                                               id="customCheck3" wire:model.defer="amenities">
                                        <label class="custom-control-label" for="customCheck3">Internet</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox">
                                        <input value="Swimming Pool" type="checkbox" class="custom-control-input"
                                               id="customCheck4" wire:model.defer="amenities">
                                        <label class="custom-control-label" for="customCheck4">Swimming Pool</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox">
                                        <input value="car parking" type="checkbox" class="custom-control-input"
                                               id="customCheck5" wire:model.defer="amenities">
                                        <label class="custom-control-label" for="customCheck5">Car Parking</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox">
                                        <input value="Balcony" type="checkbox" class="custom-control-input"
                                               id="customCheck6" wire:model.defer="amenities">
                                        <label class="custom-control-label" for="customCheck6">Balcony</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox">
                                        <input value="Garden" type="checkbox" class="custom-control-input"
                                               id="customCheck7" wire:model.defer="amenities">
                                        <label class="custom-control-label" for="customCheck7">Garden</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox">
                                        <input value="Pets allow" type="checkbox" class="custom-control-input"
                                               id="customCheck8" wire:model.defer="amenities">
                                        <label class="custom-control-label" for="customCheck8">Pets Allow</label>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox">
                                        <input value="Laundry room" type="checkbox" class="custom-control-input"
                                               id="customCheck9" wire:model.defer="amenities">
                                        <label class="custom-control-label" for="customCheck9">Laundry room</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox">
                                        <input value="Gym" type="checkbox" class="custom-control-input"
                                               id="customCheck10" wire:model.defer="amenities">
                                        <label class="custom-control-label" for="customCheck10">Gym</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox">
                                        <input value="Alarm" type="checkbox" class="custom-control-input"
                                               id="customCheck11" wire:model.defer="amenities">
                                        <label class="custom-control-label" for="customCheck11">Alarm</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox">
                                        <input value="Swimming pool" type="checkbox" class="custom-control-input"
                                               id="customCheck12" wire:model.defer="amenities">
                                        <label class="custom-control-label" for="customCheck12">Swimming
                                            Pool</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse mt-3 align-items-start float-left">
                          <a href="#location" data-toggle="tab" aria-expanded="false">
                              <button type="button" class="btn btn-primary">PREV</button>
                          </a>
                        </div>
                        <div class="d-flex flex-row-reverse mt-3 align-items-start">
                        <a href="#images" data-toggle="tab" aria-expanded="false">
                            <button type="button" class="btn btn-primary">NEXT</button>
                        </a>
                        </div>
                    </div>
                    <div class="tab-pane" id="images" wire:ignore.self>
                        <div class="mx-3">
                            <div class="alert alert-info" role="alert">
                                <ul>
                                    <li>{{ __('property.Max file size allowed is 5MB') }}</li>
                                    <li>{{ __('property.Upload only images of type jpg, gif or png') }}</li>
                                </ul>
                            </div>

                            <div class="form-group">
                                <label class="tx-bold">{{ __('property.Property Images') }}</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control " placeholder="Upload Property Images"
                                           multiple wire:model.lazy="photos" aria-label="Property Images"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">
                                            <div class="spinner-border spinner-border-sm" wire:loading
                                                 wire:target="photos" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                @error('photos') <span class="text-danger tx-bold">{{ $message }}</span> @enderror
                                @error('photos.*')
                                <span class="text-danger tx-bold">{{ $message }}</span>
                                @enderror



                                @if ($photos && !$errors->has('photos.*'))
                                    @foreach($photos as $photo)
                                        <div class="img-wrap mr-2 mb-2" wire:key="{{$loop->index}}">
                                            <span wire:click="removePhoto({{ $loop->index }})"
                                                  class="close">&times;</span>
                                            <img src="{{ $photo->temporaryUrl() }}" alt="image" style="width:auto;"
                                                 class="img-fluid avatar-xl rounded">
                                        </div>
                                    @endforeach

                                @endif


                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse mt-3 align-items-start float-left">
                          <a href="#features" data-toggle="tab" aria-expanded="false">
                              <button type="button" class="btn btn-primary">PREV</button>
                          </a>
                        </div>
                        <div class="d-flex flex-row-reverse mt-3 align-items-start">
                        <button class="btn btn-success waves-effect waves-light" wire:click="createProperty"
                                wire:attr="disabled">
                            <span class="spinner-border spinner-border-sm" wire:loading wire:target="createProperty"
                                  role="status" aria-hidden="true"></span>
                            Create Property
                        </button>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse mt-3 align-items-start">

                        {{-- <button class="btn btn-success waves-effect waves-light" wire:click="createProperty"
                                wire:attr="disabled">
                            <span class="spinner-border spinner-border-sm" wire:loading wire:target="createProperty"
                                  role="status" aria-hidden="true"></span>
                            Create Property
                        </button> --}}

                        @if (count($errors) > 0 )
                            <div class="alert alert-danger alert-dismissible fade show mr-3" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <i class="mdi mdi-block-helper mr-2"></i> {{ __('property.Fill all required fields to proceed.') }}
                            </div>
                        @endif


                    </div>
                </div>
            </div>
            <!-- end card-box-->
        </div>

        @push('footer-scripts')

            {{-- <script
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"
            async defer></script> --}}



            <script>
                let placeSearch;
                let autocomplete;
                const componentForm = {
                    street_number: "short_name",
                    route: "long_name",
                    locality: "long_name",
                    administrative_area_level_1: "short_name",
                    country: "long_name",
                    postal_code: "short_name",
                };

                function initAutocomplete() {
                    // Create the autocomplete object, restricting the search predictions to
                    // geographical location types.
                    autocomplete = new google.maps.places.Autocomplete(
                        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                        {types: ['geocode']});

                    // Avoid paying for data that you don't need by restricting the set of
                    // place fields that are returned to just the address components.
                    autocomplete.setFields(["address_component", "geometry"]);
                    // When the user selects an address from the drop-down, populate the
                    // address fields in the form.
                    autocomplete.addListener("place_changed", fillInAddress);
                }


                function fillInAddress() {
                    // Get the place details from the autocomplete object.
                    var place = autocomplete.getPlace();


                    console.log(place);


                    for (const component in componentForm) {
                        document.getElementById(component).value = "";
                        document.getElementById(component).disabled = false;
                    }

                    // Get each component of the address from the place details,
                    // and then fill-in the corresponding field on the form.
                    for (const component of place.address_components) {
                        const addressType = component.types[0];

                        if (componentForm[addressType]) {
                            const val = component[componentForm[addressType]];
                            document.getElementById(addressType).value = val;

                            document.getElementById('address_longitude').value = place.geometry.location.lng();
                            document.getElementById('address_latitude').value = place.geometry.location.lat();
                        }
                    }


                    // document.getElementById('address_latitude').value = place.geometry.location.lat();


                    document.getElementById('custom_address').value = document.getElementById('street_number').value + ' ' + document.getElementById('route').value;

                    setFieldsToLivewireProperties();
                }

                function geolocate() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            var geolocation = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            var circle = new google.maps.Circle({
                                center: geolocation,
                                radius: position.coords.accuracy
                            });
                            autocomplete.setBounds(circle.getBounds());
                        });
                    }
                }

                function setFieldsToLivewireProperties() {
                @this.set('street_address', document.getElementById('custom_address').value)
                @this.set('city', document.getElementById('locality').value)
                @this.set('zip', document.getElementById('postal_code').value)
                @this.set('state', document.getElementById('administrative_area_level_1').value)
                @this.set('longitude', document.getElementById('address_longitude').value)
                @this.set('latitude', document.getElementById('address_latitude').value)
                    // @this.set('country',  document.getElementById('country').value)

                }

            </script>

            <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&libraries=places"
                    async
                    defer>
            </script>

        @endpush

    </div>
