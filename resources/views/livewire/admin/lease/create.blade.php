<div>

    @push('header-css')
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css"
              integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A=="
              crossorigin="anonymous"/>

    @endpush

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">{{ __('lease.Create Lease') }}</h4>
                    <p class="sub-header">
                        {{ __('lease.Complete all the required details') }}
                    </p>
                    
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
                                <input type="checkbox" id="inlineCheckbox2" value="true" wire:model="isUnitLease">
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
                                <label>{{ __('lease.Deposit Paid') }}</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            @setting('currency_symbol')

                                        </span>
                                    </div>
                                    <input type="number" min="0.0" wire:model="deposit" class="form-control"
                                           aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                @error('deposit')
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
                                <label for="billing-email-address">{{ __('lease.Select Tenant') }} </label>
                                <select class="form-control" wire:model="tenantId">
                                    <option class="text-muted" label="Select Tenant"></option>
                                    @forelse ($tenants as $item=>$id)
                                        <option class="font-weight-semibold" value="{{$id}}">{{ $item }}</option>
                                    @empty

                                    @endforelse
                                </select>
                                @error('tenantId')
                                <span class="text-danger font-weight-semibold">
                                    {{ $message}}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('lease.Tenant ID') }}</label>
                                <input class="form-control custom-readonly" type="text" readonly
                                       value="{{ $tenantIdentity}}"/>

                            </div>
                        </div>

                    </div>
                    <!-- end row -->
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

                    <div class="row mt-4">
                        <div class="col-sm-6">
                        </div> <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-sm-right mt-2 mt-sm-0">
                                <button class="btn btn-success waves-effect waves-light" wire:click="createLease"
                                        wire:attr="disabled">
                                    <span class="spinner-border spinner-border-sm" wire:loading
                                          wire:target="createLease" role="status" aria-hidden="true"></span>
                                    {{ __('lease.Finalize Lease') }}
                                </button>


                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Bills</h4>
                    <p class="sub-header">
                        {{ __('lease.Include/Exclude bills when generating invoice') }}
                    </p>


                    <div class="table-responsive ">
                        <table class="table table-borderless table-sm table-nowrap mb-0">
                            <tbody>
                            <tr>
                                <td>

                                    <div class="custom-control custom-checkbox ">
                                        <input type="checkbox" class="custom-control-input" id="gasCheck"
                                               wire:model="includeGas" value="true">
                                        <label class="custom-control-label" for="gasCheck"></label>
                                    </div>

                                </td>
                                <td class="text-body font-weight-semibold">Gas</td>
                                <td>
                                    <input
                                        class="form-control form-control-sm @error('gasAmount') is-invalid @enderror "
                                        type="number" {{ $includeGas ? '':'disabled'}} placeholder="Amount"
                                        value="{{ $includeGas ? $gasAmount:''}}" wire:model="gasAmount">
                                </td>
                            </tr>
                            <tr>
                                <td>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="electCheck"
                                               value="true" wire:model="includeElectricity">
                                        <label class="custom-control-label" for="electCheck"></label>
                                    </div>

                                </td>
                                <td class="text-body font-weight-semibold">Electricity</td>
                                <td>
                                    <input
                                        class="form-control form-control-sm @error('electricityAmount') is-invalid @enderror "
                                        type="number" placeholder="Amount" {{ $includeElectricity ? '':'disabled'}}
                                        placeholder="Amount"
                                        value="{{ $includeElectricity ? $electricityAmount:''}}"
                                        wire:model="electricityAmount">
                                </td>
                            </tr>
                            <tr>
                                <td>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="netCheck"
                                               value="true" wire:model="includeInternet">
                                        <label class="custom-control-label" for="netCheck"></label>
                                    </div>

                                </td>
                                <td class="text-body font-weight-semibold">Internet</td>
                                <td>
                                    <input
                                        class="form-control form-control-sm @error('internetAmount') is-invalid @enderror "
                                        type="number" placeholder="Amount" {{ $includeInternet ? '':'disabled'}}
                                        placeholder="Amount" value="{{ $includeInternet ? $internetAmount:''}}"
                                        wire:model="internetAmount">
                                </td>
                            </tr>
                            <tr>
                                <td>

                                    <div class="custom-control custom-checkbox ">
                                        <input type="checkbox" class="custom-control-input" id="taxCheck"
                                               value="true" wire:model="includeTax">
                                        <label class="custom-control-label" for="taxCheck"></label>
                                    </div>

                                </td>
                                <td class="text-body font-weight-semibold">Tax</td>
                                <td>
                                    <input
                                        class="form-control form-control-sm @error('taxAmount') is-invalid @enderror "
                                        type="number" placeholder="Amount" {{ $includeTax ? '':'disabled'}}
                                        placeholder="Amount" value="{{ $includeTax ? $taxAmount:''}}"
                                        wire:model="taxAmount">
                                </td>
                            </tr>
                            </tbody>
                        </table>


                        <p class="text-danger font-weight-semibold mb-0">@error('gasAmount') {{ $message}} @enderror</p>
                        <p class="text-danger font-weight-semibold mb-0">@error('internetAmount') {{ $message}}
                            @enderror</p>
                        <p class="text-danger font-weight-semibold mb-0">@error('electricityAmount') {{ $message}}
                            @enderror</p>
                        <p class="text-danger font-weight-semibold mb-0">@error('taxAmount') {{ $message}} @enderror</p>

                    </div>

                    <!-- end table-responsive -->


                </div> <!-- end card-body -->
            </div> <!-- end card -->


            @if (count($errors->all())>0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{ __('lease.Ensure you have filled all required details!') }}
                </div>
            @endif

        </div> <!-- end col -->
    </div>

    @push('footer-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
                integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
                crossorigin="anonymous">
        </script>
    @endpush
</div>
