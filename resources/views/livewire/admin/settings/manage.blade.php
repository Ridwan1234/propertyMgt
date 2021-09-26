<div>
    <div class="row">
        <div class="col-12">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="firstname">Currency Name</label>
                <input type="text" class="form-control" wire:model="currencyName">
                @error('currencyName'){{ $message }} @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="lastname">Currency Symbol</label>
                <input type="text" class="form-control" wire:model="currencySymbol">
                @error('currencySymbol'){{ $message }} @enderror
            </div>
        </div> <!-- end col -->
        <div class="col-md-12 mt-3">
            <div class="form-group">
                <label for="lastname">Invoices Generated On Date Every Month</label>
                <input type="number" class="form-control" wire:model="invoiceGenerationDate">
                @error('invoiceGenerationDate'){{ $message }} @enderror
            </div>
        </div> <!-- end col -->
        <div class="col-md-12 mt-3">
            <div class="form-group">
                <label for="lastname">Invoices will be due after how many days after generation</label>
                <input type="number" class="form-control" wire:model="invoiceDueDays">
                @error('invoiceDueDays'){{ $message }} @enderror
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="text-right">
        <button type="submit" wire:click="saveSettings" class="btn btn-success waves-effect waves-light mt-2">
            <i class="mdi mdi-content-save"></i>
            Save Settings
        </button>
    </div>
</div>