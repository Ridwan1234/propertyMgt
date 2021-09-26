<a href="{{ route('admin.tenant.show',$tenant->id)}}" class="action-icon mr-1"> <i title="view" class="mdi mdi-eye"></i></a>

@permission('tenant-update')
<a href="{{ route('admin.tenant.edit',$tenant->id)}}" class="action-icon mr-1"> <i title="edit"
        class="mdi mdi-square-edit-outline"></i></a>

@endpermission

@permission('tenant-delete')
<form action="{{ route('admin.tenant.delete',$tenant->id)}}" method="GET" style="display: inline;">

    @method('GET')
    @csrf
    <button title="deactivate" class="btn-delete action-icon" type="submit"
        onclick="return confirm('Are you sure you want to deactivate this tenant ? If you wish to proceed, first make sure you have terminated all active leases that this tenant has.')">
        <i class="mdi mdi-eye-off text-danger"></i></button>
</form>
@endpermission

@permission('tenant-delete')
<form action="{{ route('admin.tenant.destroy',$tenant->id)}}" method="POST" style="display: inline;">

    @method('DELETE')
    @csrf
    <button title="delete" class="btn-delete action-icon" type="submit"
        onclick="return confirm('Are you sure you want to delete this tenant ? If you wish to proceed,first make sure you have terminated all active leases that this tenant has.')">
        <i class="mdi mdi-trash-can-outline text-danger"></i></button>
</form>
@endpermission
