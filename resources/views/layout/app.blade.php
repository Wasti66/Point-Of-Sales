<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        x-bakary | @yield('title') 
    </title>
    <!-- CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/progress.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/toastify.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
</head>
<body>
    <!-- -->
    @include('component.loder.loder')
    <!-- Header -->
    <header></header>
    <!-- Main -->
    <main>
       @yield('contant')
    </main>
    <!-- Footer -->
    <footer></footer>
    <!-- JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>