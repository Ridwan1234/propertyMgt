<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Manage Permissions</h4>
                    <p class="sub-header">Control what the users with roles of <strong>Agent and Staff</strong>
                        can view from the main dashboard.
                    </p>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="mb-1 font-weight-bold text-muted">User Name</label>
                            <input type="text" value="{{ $userName}}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="mb-1 font-weight-bold text-muted">Email</label>
                            <input type="text" class="form-control" value="{{ $userEmail}}" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="mb-1 font-weight-bold text-muted">Role</label>
                            <input type="text" class="form-control" value="{{ $userRole }}" disabled>
                        </div>


                    </div>

                    <h5 class="mb-2">Assign/Remove permissionhhhs</h5>

                    <div class="row mb-3">

                        @forelse ($permissions as $permission)
                        <div class="col-3 mb-1">
                            <div class="custom-control custom-checkbox" wire:key='chk-{{$loop->index}}'>
                                <input type="checkbox" class="custom-control-input" wire:model="userPermissions"
                                    value="{{$permission->name}}" id="check-{{$loop->index}}">
                                <label class="custom-control-label text-muted" for="check-{{$loop->index}}">
                                    {{ $permission->display_name ?? $permission->name}}
                                </label>
                            </div>
                        </div>
                        @empty

                        @endforelse

                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <a href="{{ route('admin.manage-user.index')}}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left"></i> Back to Users List </a>
                        </div> <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-sm-right mt-2 mt-sm-0">
                               
                                    <button class="btn btn-primary waves-effect waves-light" wire:click="updatePermissions"
                                        wire:attr="disabled">
                                        <span class="spinner-border spinner-border-sm" wire:loading
                                            wire:target="updatePermissions" role="status" aria-hidden="true"></span>
                                        Update Permissions</button>
                            </div>
                        </div> <!-- end col -->
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
</div>