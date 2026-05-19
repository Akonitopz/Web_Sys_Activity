<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Agriculture System Architecture</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] flex items-center justify-center min-h-screen">

    <div class="text-center">
        
        <img src="{{ asset('images/system.jpg') }}" 
             alt="System Image" 
             class="w-[500px] mx-auto mb-6 rounded-lg shadow">

        <h1 class="text-2xl font-bold">
            Welcome to My System
        </h1>

        <p class="text-gray-600 mt-2">
            Laravel Customized Welcome Page
        </p>

    </div>

</body>
</html>