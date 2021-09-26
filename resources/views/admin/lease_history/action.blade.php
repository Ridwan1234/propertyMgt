@permission('lease_history-delete')
<form action="{{ route('admin.lease-history.destroy',$lease->id)}}" method="POST" style="display: inline;">
    @method('DELETE')
    @csrf
    <button class="btn-delete action-icon" type="submit"
        onclick="return confirm('Are you sure you want to completely delete this lease history ?')">
        <i class="mdi mdi-trash-can-outline text-danger"></i>
    </button>
</form>

@endpermission