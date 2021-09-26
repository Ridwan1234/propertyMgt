<a href="{{ route('admin.property.show',$property->id)}}" class="action-icon mr-1"> <i
                class="mdi mdi-eye text-primary"></i></a>


@permission('property-update')

<a href="{{ route('admin.property.edit',$property->id)}}" class="action-icon mr-1">
        <i class="mdi mdi-square-edit-outline"></i>
</a>

@endpermission

@permission('property-delete')
<form action="{{ route('admin.property.destroy',$property->id)}}" method="POST" style="display: inline;">

        @method('DELETE')
        @csrf

        <button class="btn-delete action-icon" type="submit"
                onclick="return confirm('Are you sure you want to property ?')">
                <i class="mdi mdi-trash-can-outline text-danger"></i></button>
</form>
@endpermission