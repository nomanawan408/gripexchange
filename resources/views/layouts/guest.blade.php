<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>MNA Capitals</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            /* Custom Box Shadow for the card */
            .shadow-custom {
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2), 0 6px 6px rgba(0, 0, 0, 0.15);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-50 to-blue-100">
        <div class="min-h-screen flex flex-col justify-center items-center">
            <!-- Logo Section -->
            <div class="mb-8  text-center">
                <a href="/">
                      <!-- Logo Placeholder -->
                        <img src="{{ asset('/img/logo.png')}}" class="ml-5" style="width:250px">
                </a>
                <h1 class="mt-4 text-2xl font-semibold text-blue-700">Welcome to MNA Capitals</h1>
                <p class="mt-1 text-gray-600 text-sm">Your gateway to secure investments</p>
            </div>

            <!-- Card Section -->
            <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-custom rounded-lg">
                <!-- Slot Content -->
                {{ $slot }}
            </div>

            <!-- Footer Section -->
            <footer class="mt-8 text-center text-gray-600 text-sm">
                &copy; {{ date('Y') }} MNA Capitals. All rights reserved.
            </footer>
        </div>
    </body>
</html>
