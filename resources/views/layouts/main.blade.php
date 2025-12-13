<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Main blade</title>
</head>
<body>

@include('partials.header')

<div>
    @yield('content')
</div>


@include('partials.footer')
    
</body>
</html>