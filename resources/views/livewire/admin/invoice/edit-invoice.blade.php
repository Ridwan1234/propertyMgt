<div>
    <div class="modal-body">

        <div class="alert alert-warning" role="alert">
            <i class="mdi mdi-alert-outline mr-2"></i> <strong>
                {{ __('invoice.Adjusting invoice is not recommended. Only do this IF AND ONLY IF its extremely important.') }}
            </strong>

        </div>
        <div class="form-group mb-3">
            <label>{{ __('invoice.Payable Rent') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">@setting('currency_symbol')</span>
                </div>
                <input type="number" min="0.0" wire:model="payableRent" class="form-control"
                       aria-describedby="basic-addon1">

            </div>
            @error('payableRent') <span class="text-danger font-weight-semibold">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-3">
            <label>{{ __('invoice.Included Bills Total') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon2">@setting('currency_symbol')</span>
                </div>
                <input type="number" min="0.0" wire:model="payableBills" class="form-control"
                       aria-describedby="basic-addon2">

            </div>
            @error('payableBills') <span class="text-danger font-weight-semibold">{{ $message }}</span> @enderror
        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" wire:click="updateInvoice" wire:attr="disabled">
            <span class="spinner-border spinner-border-sm" wire:loading wire:target="updateInvoice" role="status"
                  aria-hidden="true"></span>
            {{ __('invoice.Save Changes') }}
        </button>
    </div>
</div>
