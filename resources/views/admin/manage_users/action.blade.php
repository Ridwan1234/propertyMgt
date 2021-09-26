@if ($user->hasRole(['agent|staff']))
<a href="{{ route('admin.manage-permissions',$user->id)}}" class="btn btn-xs btn-soft-dark">Permissions</a>
@endif

@if (auth()->id()!=$user->id)
<form action="{{ route('admin.manage-user.destroy',$user->id)}}" method="POST" style="display: inline;">
    @method('DELETE')
    @csrf
    <button class="btn btn-xs btn-danger" type="submit" onclick="return confirm('Are you sure you delete this user ?')">
        <i class="mdi mdi-minus"></i>
    </button>
</form>

@endif