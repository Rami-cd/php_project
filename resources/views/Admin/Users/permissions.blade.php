
<div class="container">
    <h2>Manage Permissions for {{ $user->name }}</h2>

    <form method="POST" action="{{ route('admin.users.permissions.update', $user) }}">
        @csrf

        <div class="mb-3">
            <label>Select Permissions:</label>
            <div class="form-check">
                @foreach($permissions as $permission)
                    <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permission->name }}"
                        {{ in_array($permission->name, $userPermissions) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ ucfirst($permission->name) }}</label>
                    <br>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Permissions</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
