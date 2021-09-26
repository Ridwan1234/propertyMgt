<a href="{{ route('admin.property-unit.show',$room->id)}}" class="action-icon">
        <i class="mdi mdi-eye text-primary"></i>
</a>

@permission('unit-update')
<a href="{{ route('admin.property-unit.edit',$room->id)}}" class="action-icon">
        <i class="mdi mdi-square-edit-outline"></i>
</a>

@endpermission

@permission('unit-delete')
<form action="{{ route('admin.property-unit.destroy',$room->id)}}" method="POST" style="display: inline;">

        @method('DELETE')
        @csrf

        <button class="btn-delete action-icon" type="submit"
                onclick="return confirm('Are you sure you want to property unit ?')">
                <i class="mdi mdi-trash-can-outline text-danger"></i></button>
</form>

@endpermission