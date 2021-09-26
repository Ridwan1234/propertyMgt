<a href="{{ route('admin.lease.show',$lease->id)}}" class="action-icon text-primary mr-1">
    <i class="mdi mdi-eye"></i>
</a>


@permission('lease-update')

<a href="{{ route('admin.lease.edit',$lease->id)}}" class="action-icon text-success mr-1">
    <i class="mdi mdi-square-edit-outline"></i>
</a>
@endpermission


@permission('lease-delete')
<form action="{{ route('admin.lease.destroy',$lease->id)}}" method="POST" style="display: inline;">

    @method('DELETE')
    @csrf

    <button class="btn-delete action-icon" type="submit"
        onclick="return confirm('Are you sure you want to delete this lease ?')">
        <i class="mdi mdi-trash-can-outline text-danger"></i></button>
</form>
@endpermission