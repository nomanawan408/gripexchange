<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MNA Capitals - Login</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/styleweb.css')}}">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="">
        <header class="bg-orange-300">
            <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex-1 md:flex md:items-center md:gap-12">
                        <a class="text-3xl font-extrabold sm:text-5x text-orange-800" href="s#">
                            <img src="{{ asset('img/logo.png') }}" alt="" width="120px">
                        </a>
                    </div>
                    <div class="md:flex md:items-center md:gap-12">
                        <nav aria-label="Global" class="hidden md:block">
                            <ul class="flex items-center gap-6 text-sm">
                                <li>
                                    <a class="text-orange-800 transition hover:text-orange-900" href="/"> Home </a>
                                </li>
                                <li>
                                    <a class="text-orange-800 transition hover:text-orange-900" href="{{ route('contact-us.index') }}"> Contact us </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="flex items-center gap-4">
                            @if (Route::has('login'))
                                <div class="sm:flex sm:gap-4">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="font-semibold text-orange-800 hover:text-orange-800 dark:text-orange-800 dark:hover:text-orange-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-orange-500">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="rounded-md bg-orange-300 px-5 py-2.5 text-sm font-medium text-orange-950 shadow">Log in</a>
                                        @if (Route::has('register'))
                                            <div class="hidden sm:flex">
                                                <a href="{{ route('register') }}" class="rounded-md bg-orange-900 px-5 py-2.5 text-sm font-medium text-orange-300">Register</a>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                            <div class="block md:hidden">
                                <button class="rounded bg-orange-100 p-2 text-orange-800 transition hover:text-orange-600">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="size-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="bg-orange-50 py-16">
            <h1 class="text-4xl font-bold text-orange-800 text-center mb-12">MNA Cap - Login</h1>
            <div class="container mx-auto px-4">
                <div class="max-w-2xl mx-auto">
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <div class="text-center mb-6">
                        </div>

                        <!-- Session Status -->
                        @if(session('status'))
                            <div class="mb-4 text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input 
                                    id="email" 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    autofocus 
                                    autocomplete="username"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500 text-gray-900 sm:text-sm"
                                />
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input 
                                    id="password" 
                                    type="password" 
                                    name="password" 
                                    required 
                                    autocomplete="current-password"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500 text-gray-900 sm:text-sm"
                                />
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="flex items-center">
                                <input 
                                    id="remember_me" 
                                    type="checkbox" 
                                    name="remember" 
                                    class="h-4 w-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500"
                                />
                                <label for="remember_me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center justify-between">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('register') }}" class="text-sm text-orange-600 hover:underline">Create Account?</a>
                                @endif
                                
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-sm text-orange-600 hover:underline">Forgot your password?</a>
                                @endif

                                <button 
                                    type="submit" 
                                    class="inline-flex justify-center px-6 py-2 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-lg shadow-sm hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                                >
                                    Log in
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-orange-900 py-8">
            <div class="container mx-auto px-4">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-orange-100 mb-4">Get in Touch</h3>
                    <p class="text-orange-100 mb-6">We're here to help and answer any questions you might have.</p>
                </div>
                <div class="text-center text-orange-100 mt-8">
                    <p>MNA Cap © 2024. All rights reserved</p>
                </div>
            </div>
        </footer>
    </body>
</html>