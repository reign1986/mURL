<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="container">
    @yield('content')
</div>

@yield('javascript')

</body>
</html>