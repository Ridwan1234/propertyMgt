<div>
    <button class="btn btn-sm btn-soft-danger mr-1 ml-1"
            onclick="confirm('{{__('invoice.Mark this invoice as UNPAID ?')}}') || event.stopImmediatePropagation()"
            wire:click="unpayNow" wire:attr="disabled">
        <span class="spinner-border spinner-border-sm" wire:loading wire:target="unpayNow" role="status"
              aria-hidden="true"></span>
        {{ __('invoice.Revoke Payment') }}
    </button>
</div>
