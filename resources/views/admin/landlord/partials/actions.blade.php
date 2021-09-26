<a href="{{ route('admin.landlord.show',$landlord->id)}}" class="action-icon text-primary"> <i
                class="mdi mdi-eye mr-1"></i></a>

@permission('landlord-update')
<a href="{{ route('admin.landlord.edit',$landlord->id)}}" class="action-icon text-success mr-1"> <i
                class="mdi mdi-square-edit-outline"></i></a>

@endpermission

@permission('landlord-delete')

<form action="{{ route('admin.landlord.destroy',$landlord->id)}}" method="POST" style="display: inline;">

        @method('DELETE')
        @csrf

        <button class="btn-delete action-icon" type="submit"
                onclick="return confirm('Are you sure you want to delete this landlord ?')"> <i
                        class="mdi mdi-delete text-danger"></i></button>
</form>

@endpermission