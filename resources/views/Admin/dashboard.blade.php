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
        <h1>Admin Dashboard</h1>
        <div class="row mt-5">
            <div class="col-md-6">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage Users</a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('admin.courses.index') }}" class="btn btn-primary">Manage Courses</a>
            </div>
        </div>
    </div>
</body>
</html>