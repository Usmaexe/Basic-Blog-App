<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>{{-- Script for the CKEDITOR --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

</head>
<body class="antialiased">
    @include('inc.navbar');
    <div class="contents">
        @include('inc.messages')
        @yield('content')
    </div>
</body>
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
<script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    
    $(document).ready(function() {
        CKEDITOR.replace('article-ckeditor');
    });

</script>
<script>
    function handleDropdownClick(event) {
        const dropdown = event.currentTarget;

        dropdown.addEventListener('click', function(event) {
            event.stopPropagation();
            dropdown.classList.toggle('show');
        });

        document.addEventListener('click', function(event) {
            dropdown.classList.remove('show');
        });
    }
</script>

</html>
