<div>
    <div class="modal-body">
        <div class="form-group mb-3">
            <label for="example-fileinput">Default file input</label>
            <input type="file" id="example-fileinput-{{ $iteration}}" class="form-control" wire:model="document">
            @error('document')
            <span class="font-weight-semibold text-danger">{{ $message}}</span>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lease.Close') }}</button>


        <button class="btn btn-primary waves-effect waves-light" wire:click="addDocument" wire:attr="disabled">
            <span class="spinner-border spinner-border-sm" wire:loading wire:target="addDocument" role="status"
                  aria-hidden="true"></span>
            {{ __('lease.Upload Document') }}
        </button>
    </div>


</div>
