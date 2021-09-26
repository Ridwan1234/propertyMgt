<div>
    <div class="card-box">


        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Update Password</h5>
        <div class="row">

            <div class="col-12">
                @if (session()->has('updated-password'))
                <div class="alert alert-success">
                    {{ session('updated-password') }}
                </div>
                @endif
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" wire:model="current_password">
                    @error('current_password') <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password">
                    @error('password') <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Repeat Password</label>
                    <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" wire:model="password_confirmation">
                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- end col -->
        </div> <!-- end row -->


        <div class="text-right">
            <button class="btn btn-primary  waves-effect waves-light mt-2" wire:click="updatePassword"
                wire:loading.attr="disabled">
                <span class="spinner-border spinner-border-sm mr-2" wire:loading wire:target="updatePassword"
                    role="status" aria-hidden="true"></span>
                Update Password
            </button>
        </div>

    </div>
</div>