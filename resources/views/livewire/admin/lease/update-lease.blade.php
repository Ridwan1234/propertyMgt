<div>

    @push('header-css')
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css"
              integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A=="
              crossorigin="anonymous"/>

    @endpush

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <!-- end row -->
                    <div class="row">
                        <div class="col-md-4">
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
                        <div class="col-md-4">
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

                        <div class="col-md-4">
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
                                <button class="btn btn-success waves-effect waves-light" wire:click="updateLease"
                                        wire:attr="disabled">
                                    <span class="spinner-border spinner-border-sm" wire:loading
                                          wire:target="updateLease" role="status" aria-hidden="true"></span>
                                    {{ __('lease.Update Lease') }}
                                </button>


                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->


    </div>

    @push('footer-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
                integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
                crossorigin="anonymous">
        </script>
    @endpush
</div>
