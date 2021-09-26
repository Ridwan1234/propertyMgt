<div>
    <button class="btn btn-sm btn-info"
            onclick="confirm('{{__('invoice.Are you sure you want to pay this invoice ?')}}') || event.stopImmediatePropagation()"
            wire:click="payNow" wire:attr="disabled">
        <span class="spinner-border spinner-border-sm" wire:loading wire:target="payNow" role="status"
              aria-hidden="true"></span>
       Pay Now
    </button>
</div>
