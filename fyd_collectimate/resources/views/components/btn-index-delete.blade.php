
<form method="POST" class="form d-inline" action="{{ route($route.'.destroy', [$route_var => $route_val]) }} " class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" value="Delete!" class="btn btn-sm btn-outline-transparent action-btn" onclick="return confirm('Are you sure you want to delete? This action is final')">
        <i class="fa-solid fa-trash-can fs-6 text-danger"></i>
    </button>
</form>
