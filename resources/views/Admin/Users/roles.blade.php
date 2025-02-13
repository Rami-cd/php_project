
<div class="container">
    <h2>Manage Roles for {{ $user->name }}</h2>

    <form method="POST" action="{{ route('admin.users.roles.update', $user) }}">
        @csrf

        <div class="mb-3">
            <label>Select Roles:</label>
            <div class="form-check">
                @foreach($roles as $role)
                    <input type="checkbox" class="form-check-input" name="roles[]" value="{{ $role->name }}"
                        {{ in_array($role->name, $userRoles) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ ucfirst($role->name) }}</label>
                    <br>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Roles</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
