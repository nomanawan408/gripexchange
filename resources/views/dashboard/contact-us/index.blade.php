<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MNA Capitals - Contact Us</title>
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
            <div class="container mx-auto px-4">
                <h1 class="text-4xl font-bold text-orange-800 text-center mb-12">Contact Us</h1>
                <div class="max-w-3xl mx-auto">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <form action="{{ route('contact-us.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                                <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500" required>
                            </div>
                            <div>
                                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500" required>
                            </div>
                            <div>
                                <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                                <input type="text" id="subject" name="subject" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500" required>
                            </div>
                            <div>
                                <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                                <textarea id="message" name="message" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500" required></textarea>
                            </div>
                            <button type="submit" class="w-full bg-orange-600 text-white py-3 px-6 rounded-lg hover:bg-orange-700 transition-colors">Send Message</button>
                        </form>
                    </div>

                    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white p-6 rounded-lg shadow-md text-center">
                            <div class="text-orange-600 mb-4">
                                <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">Phone</h3>
                            <p class="text-gray-600">+1 234 567 890</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md text-center">
                            <div class="text-orange-600 mb-4">
                                <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">Email</h3>
                            <p class="text-gray-600">info@mnacap.com</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md text-center">
                            <div class="text-orange-600 mb-4">
                                <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">Location</h3>
                            <p class="text-gray-600">123 Business Street, City, Country</p>
                        </div>
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