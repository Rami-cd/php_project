<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Users Management</h1>

        <!-- Search and Filter -->
        <form method="GET" class="d-flex align-items-center mb-3">
            <input type="text" name="search" placeholder="Search by username or email" class="form-control mr-2" value="{{ request('search') }}">
            
            <select name="role" class="form-control mr-2">
                <option value="">All Roles</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student</option>
            </select>

            <!-- Radio buttons for search type -->
            <div class="form-check mx-2">
                <input class="form-check-input" type="radio" name="search_type" value="username" 
                    {{ request('search_type', 'username') == 'username' ? 'checked' : '' }} id="searchUsername">
                <label class="form-check-label" for="searchUsername">Username</label>
            </div>
            <div class="form-check mx-2">
                <input class="form-check-input" type="radio" name="search_type" value="email" {{ request('search_type') == 'email' ? 'checked' : '' }} id="searchEmail">
                <label class="form-check-label" for="searchEmail">Gmail Only</label>
            </div>

            <button type="submit" class="btn btn-success">Search</button>
        </form>

        <!-- Users List -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user) 
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
                        <td>
                            <a href="{{ route('admin.users.roles', $user) }}" class="btn btn-sm btn-warning">Manage Roles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <!-- Pagination -->
        {{ $users->links() }}
    </div>
</body>
</html>