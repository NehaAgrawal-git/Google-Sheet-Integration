<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta tags, title, etc. -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navbar, header, etc. -->

    <div class="container">
        @yield('content')
    </div>

    <!-- Scripts, jQuery, Bootstrap JS, etc. -->
</body>
</html>
