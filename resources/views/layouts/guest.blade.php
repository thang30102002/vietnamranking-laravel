<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- @vite('resources/css/app.css') --}}
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Scripts -->
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#21324C]">
        <div>
            <a href="/">
                <h1 style="color: #fff;font-size: 25px;font-weight: bold;"
                    class="title animate__animated  animate__bounce">VNPOOL</h1>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4  shadow-md bg-[#21324C] overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
