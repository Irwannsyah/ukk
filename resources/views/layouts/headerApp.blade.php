<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ !empty($header_title) ? $header_title : '' }} - Ticket Line</title>
    @yield('style')
     <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>
    @include('layouts.header')
    
    @yield('content')
    @yield('script')
    <script src="{{ asset('assets/js/app.js') }}"></script>
</html>
