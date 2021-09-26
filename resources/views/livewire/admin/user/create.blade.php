<div>
    <div class="modal-body p-3">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Names</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.defer="name">
                    @error('name')<span class="text-danger">{{ $message}} </span> @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        wire:model.defer="email">
                    @error('email')<span class="text-danger">{{ $message}} </span> @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Role</label>
                    <select class="form-control" wire:model="role">
                        <option value="">Select role</option>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="agent">Agent</option>
                        <option value="user">User</option>
                    </select>
                    @error('role')<span class="text-danger">{{ $message}} </span> @enderror

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Description</label>
                    <input type="text" class="form-control" wire:model.defer="description"
                        placeholder="E.g Cleaner for property XYZ">

                </div>
            </div>





        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>

        <button class="btn btn-info waves-effect waves-light" wire:click="createUser" wire:attr="disabled">
            <span class="spinner-border spinner-border-sm" wire:loading wire:target="createUser" role="status"
                aria-hidden="true"></span>
            Create User
        </button>

    </div>
</div>
