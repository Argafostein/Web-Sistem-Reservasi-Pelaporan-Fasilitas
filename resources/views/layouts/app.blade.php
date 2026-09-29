<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Fasilitas Kampus')</title>

    @vite([
        'resources/css/app.css', 
        'resources/js/app.js'
    ])

    @stack('styles')

</head>

<body> 
    @include('layouts.navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    @stack('scripts')

</body>

</html>