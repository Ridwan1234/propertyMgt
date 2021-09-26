<div>
    <div class="modal-body">
        <div class="form-group mb-3">
            <label for="example-fileinput">{{ __('lease.Bill Name') }}</label>
            <select class="form-control" wire:model="billName">
                <option class="text-muted" value="">{{ __('lease.Select bill') }}</option>
                <option class="font-weight-medium" value="Gas">Gas</option>
                <option class="font-weight-medium" value="Internet">Internet</option>
                <option class="font-weight-medium" value="Electricity">Electricity</option>
                <option class="font-weight-medium" value="Tax">Tax</option>
                <option class="font-weight-medium" value="Water">Water</option>
                <option class="font-weight-medium" value="Others">Others</option>
            </select>

            @error('billName')
            <span class="font-weight-semibold text-danger">{{ $message}}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="example-fileinput">{{ __('lease.Bill Amount') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        @setting('currency_symbol')

                    </span>
                </div>
                <input type="number" min="0.0" wire:model="billAmount" class="form-control"
                       aria-label="Bill" aria-describedby="basic-addon1">
            </div>
            @error('billAmount')
            <span class="font-weight-semibold text-danger">{{ $message}}</span>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>


        <button class="btn btn-primary waves-effect waves-light" wire:click="addBill" wire:attr="disabled">
            <span class="spinner-border spinner-border-sm" wire:loading wire:target="addBill" role="status"
                  aria-hidden="true"></span>
            {{ __('lease.Add Bill') }}
        </button>
    </div>


</div>
