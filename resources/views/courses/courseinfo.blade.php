<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Course info</h1>
    <div>{{ $course }}</div>
    @foreach ($modules as $module)
        <div>
            {{ $module }}
        </div>
    @endforeach
</body>
</html>