<a href="{{ route('admin.inventory.show',$inventory->id)}}" class="action-icon mr-1"> <i class="mdi mdi-eye"></i></a>

@permission('inventory-update')
<a href="{{ route('admin.inventory.edit',$inventory->id)}}" class="action-icon mr-1"> <i class="mdi mdi-square-edit-outline"></i></a>
@endpermission

@permission('inventory-delete')
<form action="{{ route('admin.inventory.destroy',$inventory->id)}}" method="POST" style="display: inline;">

    @method('DELETE')
    @csrf

    <button class="btn-delete action-icon" type="submit"
        onclick="return confirm('Are you sure you want to delete this inventory ?')"> <i
            class="mdi mdi-delete text-danger"></i></button>
</form>

@endpermission