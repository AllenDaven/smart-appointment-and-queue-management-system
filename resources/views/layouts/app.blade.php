<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QueueSmart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    @include('layouts.navigation') {{-- OK --}}
    
    <main class="p-6">
        @yield('content') {{-- IMPORTANT --}}
    </main>

</body>
</html>
