<div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="header-title">{{__('tenant.Register New Tenant')}}</h4>
          <p class="text-muted font-13">
            {{__('tenant.Tenant Create Subtitle.')}}
          </p>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="col-form-label">{{ __('First Name') }}</label>
              <input type="text" class="form-control @error('fname') is-invalid @enderror"
                placeholder="First name"
                wire:model.defer="fname">

                @error('fname') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-md-6">
                  <label class="col-form-label">{{ __('Last Name') }}</label>
                  <input type="text" class="form-control @error('lname') is-invalid @enderror"
                    placeholder="Last name"
                    wire:model.defer="lname">

                    @error('lname') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label class="col-form-label">{{__('tenant.Email')}}</label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" wire:model.defer="email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-md-6">
                          <label class="col-form-label">{{__('tenant.Phone Number')}}</label>
                          <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model.defer="phone">
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                          </div>
                          <div class="form-row">


                            <div class="form-group col-md-6">
                              <label class="col-form-label">{{__('tenant.Identity No / Passport')}}</label>
                              <input type="text" class="form-control @error('identityNo') is-invalid @enderror" wire:model.defer="identityNo">
                                @error('identityNo') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group col-md-6">
                                  <label class="col-form-label">{{__('tenant.Address')}}</label>
                                  <input type="text" class="form-control" wire:model.defer="address">
                                  @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                  </div>

                                </div>
                                <div class="form-row">

                                  <div class="form-group col-md-6">
                                    <label class="col-form-label">{{__('tenant.Identification Document')}}</label>
                                    <input type="file" class="form-control-file @error('identityDocument') is-invalid @enderror" wire:model.defer="identityDocument">
                                      @error('identityDocument') <span class="text-danger">{{ $message }}</span> @enderror
                                      </div>
                                    </div>


                                    <h5 class="mb-3 text-uppercase bg-light p-2">
                                      <i class="mdi mdi-office-building mr-1"></i>
                                      {{__('tenant.Place Of Work')}}
                                    </h5>

                                    <div class="form-row">
                                      <div class="form-group col-md-6">
                                        <label for="inputState" class="col-form-label">{{__('tenant.Occupation Status')}}</label>
                                        <select id="inputState" class="form-control" wire:model="occupationStatus">
                                          <option value="">{{__('tenant.Choose')}}</option>
                                          <option>Employee</option>
                                          <option>Employer</option>
                                          <option>Self Employed</option>
                                          <option>Others</option>
                                        </select>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label class="col-form-label">{{__('Occupation Details')}}</label>
                                        <input type="text" class="form-control" wire:model.defer="occupationDetails">
                                      </div>
                                    </div>

                                    <h5 class="mb-3 text-uppercase bg-light p-2">
                                      <i class="mdi mdi-office-building mr-1"></i>
                                      {{__('Incase of emergency, contact:')}}
                                    </h5>

                                    <div class="form-row">

                                      <div class="form-group col-md-6">
                                        <label class="col-form-label">{{__('tenant.Name')}}</label>
                                        <input type="text" class="form-control" wire:model.defer="emergencyContactPerson">


                                      </div>
                                      <div class="form-group col-md-6">
                                        <label class="col-form-label">{{__('tenant.Phone Number')}}</label>
                                        <input type="text" class="form-control" wire:model.defer="emergencyContactPhone">
                                      </div>
                                    </div>

                                    <h5 class="mb-3 text-uppercase bg-light p-2">
                                      <i class="mdi mdi-home mr-1"></i>
                                      {{__('Rent Informations:')}}
                                    </h5>

                                    <div class="row">
                                      <div class="col-md-8">
                                        <div class="form-group">
                                          <label for="billing-first-name">{{ __('lease.Select Property') }}</label>
                                          <select class="form-control" wire:model="propertyId">
                                            <option class="text-muted" label="Select Main property"></option>

                                            @forelse ($properties as $item=>$id)
                                              <option class="font-weight-semibold" value="{{$id}}">{{ $item }}</option>
                                            @empty

                                            @endforelse

                                          </select>

                                          @error('propertyId')
                                            <span class="text-danger font-weight-semibold">
                                              {{ $message}}
                                            </span>
                                          @enderror

                                        </div>
                                      </div>

                                      <div class="col-md-4 d-flex align-items-center">
                                        <div class="checkbox checkbox-success form-check-inline">
                                          <input type="checkbox" id="inlineCheckbox2" disabled value="true" wire:model="isUnitLease">
                                          <label for="inlineCheckbox2"> {{ __('lease.Lease Units') }}</label>
                                        </div>

                                      </div>
                                    </div> <!-- end row -->
                                    <div class="row">
                                      @if ($isUnitLease)
                                        <div class="col-md-8">
                                          <div class="form-group">
                                            <label for="billing-email-address">{{ __('lease.Property Unit') }} </label>
                                            <select class="form-control" wire:model="unitId">
                                              <option class="text-muted" label="Select Main property"></option>

                                              @forelse ($propertyUnits as $item=>$id)
                                                <option class="font-weight-semibold" value="{{$id}}">{{ $item }}</option>
                                              @empty

                                              @endforelse

                                            </select>
                                            @error('unitId')
                                              <span class="text-danger font-weight-semibold">
                                                {{ $message}}
                                              </span>
                                            @enderror
                                          </div>
                                        </div>
                                      @endif


                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="billing-phone">{{ __('lease.Rent') }}</label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon1">
                                                @setting('currency_symbol')

                                              </span>
                                            </div>
                                            <input type="text" readonly wire:model="rent" class="form-control custom-readonly"
                                            aria-label="Username" aria-describedby="basic-addon1">
                                          </div>

                                          <small class="form-text text-muted">Predefined when creating property/unit</small>

                                          @error('rent')
                                            <span class="text-danger font-weight-semibold">
                                              {{ $message}}
                                            </span>
                                          @enderror
                                        </div>
                                      </div>

                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="billing-phone">{{ __('Service Charge') }}</label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon1">
                                                @setting('currency_symbol')

                                              </span>
                                            </div>
                                            <input type="text" readonly wire:model="service" class="form-control custom-readonly"
                                            aria-label="service" aria-describedby="basic-addon1">
                                          </div>

                                          <small class="form-text text-muted">Predefined when creating property/unit</small>

                                          @error('service')
                                            <span class="text-danger font-weight-semibold">
                                              {{ $message}}
                                            </span>
                                          @enderror
                                        </div>
                                      </div>
                                    </div> <!-- end row -->

                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="billing-phone">{{ __('Caution') }}</label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon1">
                                                @setting('currency_symbol')

                                              </span>
                                            </div>
                                            <input type="text" readonly wire:model="caution" class="form-control custom-readonly"
                                            aria-label="caution" aria-describedby="basic-addon1">
                                          </div>

                                          <small class="form-text text-muted">Predefined when creating property/unit</small>

                                          @error('caution')
                                            <span class="text-danger font-weight-semibold">
                                              {{ $message}}
                                            </span>
                                          @enderror
                                        </div>
                                      </div>

                                      <div class="form-group col-md-6">
                                        <label class="col-form-label">{{__('Amount Paid')}}</label>
                                        <input type="number" class="form-control @error('paid') is-invalid @enderror" wire:model.defer="paid">
                                          @error('paid') <span class="text-danger">{{ $message }}</span> @enderror
                                          </div>

                                        </div> <!-- end row -->

                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="billing-town-city">{{ __('lease.Lease Start Date') }}</label>
                                              <div class="input-group">
                                                <input type="text" class="form-control tx-semibold" wire:model="startDate"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy"
                                                data-date-autoclose="true" id="start_date" readonly
                                                onchange="this.dispatchEvent(new InputEvent('input'))">
                                                <div class="input-group-append">
                                                  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                              </div>
                                              @error('startDate')
                                                <span class="text-danger font-weight-semibold">
                                                  {{ $message}}
                                                </span>
                                              @enderror
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="billing-state">{{ __('lease.Lease End Date') }}</label>
                                              <div class="input-group">
                                                <input type="text" class="form-control tx-semibold" wire:model="endDate"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy"
                                                data-date-autoclose="true" id="start_date" readonly
                                                onchange="this.dispatchEvent(new InputEvent('input'))">
                                                <div class="input-group-append">
                                                  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                              </div>

                                              @error('endDate')
                                                <span class="text-danger font-weight-semibold">
                                                  {{ $message}}
                                                </span>
                                              @enderror
                                            </div>
                                          </div>
                                        </div> <!-- end row -->

                                        <div class="row">
                                          <div class="col-12">
                                            <div class="form-group">
                                              <label>{{ __('lease.Upload Lease Documents') }}</label>
                                              <input type="file" wire:model="leaseDocuments" multiple class="form-control">
                                              @error('leaseDocuments')
                                                <span class="text-danger font-weight-semibold">
                                                  {{ $message}}
                                                </span>
                                              @enderror
                                            </div>
                                          </div>
                                        </div> <!-- end row -->

                                        <div class="row">
                                          <div class="col-12">
                                            <div class="form-group mt-3">
                                              <label for="example-textarea">{{ __('lease.Tenancy Terms') }}:</label>
                                              <textarea class="form-control" id="example-textarea" rows="4"
                                              wire:model.defer="leaseTerms" placeholder="Lease terms here"></textarea>
                                            </div>
                                          </div>
                                        </div> <!-- end row -->

                                      <button class="btn btn-primary waves-effect waves-light" wire:click="createTenant"
                                        wire:attr="disabled">
                                        <span class="spinner-border spinner-border-sm" wire:loading wire:target="createTenant"
                                        role="status" aria-hidden="true"></span>
                                        {{__('tenant.Register Tenant')}}
                                      </button>

                                    </div> <!-- end card-body -->
                                  </div> <!-- end card-->
                                </div> <!-- end col -->
                              </div>
                              @push('footer-scripts')
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
                                integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
                                crossorigin="anonymous">
                                </script>
                              @endpush
                            </div>
