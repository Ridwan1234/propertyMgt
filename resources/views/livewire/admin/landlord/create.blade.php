<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{ __('landlord.Register New Landlord') }}</h4>
                    <p class="text-muted font-13">
                        {{ __('landlord.Registered Header') }}
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
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Email" wire:model.defer="email">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{__('tenant.Phone Number')}}</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="Phone Number" wire:model.defer="phone">
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{__('tenant.Identity No / Passport')}}</label>
                            <input type="text" class="form-control @error('identityNo') is-invalid @enderror"
                                  placeholder="Identity No" wire:model.defer="identityNo">
                            @error('identityNo') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{__('tenant.Identification Document')}}</label>
                            <input type="file" class="form-control @error('identityDocument') is-invalid @enderror"
                                   wire:model.defer="identityDocument">
                            @error('identityDocument') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


                    </div>
                    <div class="form-row mb-3">
                        <div class="form-group col-md-4">
                            <label class="col-form-label">{{__('tenant.Address')}}</label>
                            <input type="text" class="form-control" placeholder="Address" wire:model.defer="address">
                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-form-label">{{__('landlord.Bank Associated')}} (Optional)</label>
                            <input type="text" class="form-control" placeholder="Bank" wire:model.defer="bankName">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-form-label">{{__('landlord.Bank Account No')}} (Optional)</label>
                            <input type="text" class="form-control" placeholder="Account No" wire:model.defer="bankAccount">
                        </div>


                    </div>

                    <button class="btn btn-primary waves-effect waves-light" wire:click="createLandlord"
                            wire:attr="disabled">
                        <span class="spinner-border spinner-border-sm" wire:loading wire:target="createLandlord"
                              role="status" aria-hidden="true"></span>
                        {{__('landlord.Register Landlord')}}
                    </button>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div>
