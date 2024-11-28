<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MNA Capitals</title>
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
                        <a class="text-orange-800 transition hover:text-orange-900" href="#"> Home </a>
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
  <section class="relative bg-cover bg-center bg-no-repeat" style="background-image: url('https://images.pexels.com/photos/844124/pexels-photo-844124.jpeg')">
              <div class="absolute inset-0 bg-black/75 sm:bg-transparent sm:from-black/95 sm:to-black/25 sm:bg-gradient-to-r"></div>
  
              <div class="relative mx-auto max-w-screen-xl px-4 py-32 sm:px-6 lg:flex lg:h-screen lg:items-center lg:px-8">
                  <div class="max-w-xl text-center sm:text-left">
                      <h1 class="text-3xl font-extrabold sm:text-5xl text-orange-300">
                       Embracing the Future of Cryptocurrency
                      </h1>
  
                      <p class="mt-4 max-w-lg sm:text-xl/relaxed text-white">
                        Your Ultimate Gateway to the Digital Economy
                      </p>

                      <p class="mt-4 max-w-lg sm:text-lg/relaxed text-orange-200">
                        Join the revolution of blockchain-powered investments, where your capital works smarter, not harder.
                      </p>
  
                      <div class="mt-8 flex flex-wrap gap-4 text-center">
                          <a href="{{ url('/register') }}" class="block w-full rounded bg-orange-600 px-12 py-3 text-sm font-medium text-white shadow hover:bg-orange-700 focus:outline-none focus:ring active:bg-orange-500 sm:w-auto">
                              Get Started
                          </a>

                      </div>
                  </div>
              </div>
          </section>
<section class="bg-orange-50 py-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="w-full md:w-1/2">
                <h2 class="text-3xl font-bold text-orange-800 mb-8">Welcome to MNA Cap Digital</h2>
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Where Your Investments Thrive.</h3>
                <p class="text-xl text-gray-600 mb-8">At MNA Cap Digital, we are more than just a platform; we are your trusted partner in navigating the dynamic world of cryptocurrency and digital finance. With years of expertise and a commitment to empowering individuals and businesses, we provide innovative solutions to grow your investments in today's digital economy.
                    <br>Our mission is simple: To help you unlock the full potential of your capital and achieve sustainable financial growth.</p>
                
                <div class="grid gap-4 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <p class="text-gray-700">MNA Cap Digital is Secured, Convenient and Easy to use.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <p class="text-gray-700">MNA Cap Digital is not only a platform but a comprehensive financial solution.</p>
                    </div>
                </div>
                
                <div class="bg-orange-100 p-6 rounded-lg mb-8">
                    <p class="text-orange-900 text-lg">Join our community and grow together</p>
                </div>
               
            </div>
            <div class="w-full md:w-1/2">
                <img src="{{ asset('img/web1.jpg') }}" alt="MNA Cap Digital" class="rounded-lg shadow-lg w-full">
            </div>
        </div>
        
    </div>
</section>


<section class="bg-white py-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between gap-12">
            <div class="w-full md:w-1/2">
                <img src="{{ asset('/img/web2.jpg') }}" alt="Who We Are" class="rounded-lg shadow-xl w-full">
            </div>
            <div class="w-full md:w-1/2">
                <h2 class="text-3xl font-bold text-orange-800 mb-6">Who We Are</h2>
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Empowering Investors to Achieve Financial Success</h3>
                <p class="text-lg text-gray-600 mb-8">
                    At MNA Cap, we specialize in helping individuals and organizations grow their wealth through smart, data-driven investment strategies. With a track record of consistent returns, our team of seasoned financial experts is dedicated to maximizing your investments while minimizing risk.
                </p>
                <p class="text-lg text-gray-600 mb-8">
                    Whether you're a seasoned investor or just starting out, we provide tailored solutions designed to help you reach your financial goals.
                </p>
                <div class="bg-orange-50 p-6 rounded-lg shadow-md">
                    <div class="flex items-center gap-4">
                        <div class="text-orange-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-800 font-medium">Expert-driven investment strategies tailored to your needs</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="bg-orange-50 py-8">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <p class="text-gray-600">
                For More Details Contact <a href="mailto:support@mnacap.com" class="text-orange-800 hover:text-orange-900">Support@mnacap.com</a>
                <span class="mx-2">|</span>

                Address: Corporate Avenue, Office 15
                Edinburgh
                EH1 3YZ

                <span class="mx-2">|</span>
                <span class="text-gray-500">Terms & Conditions apply</span>
            </p>
        </div>
    </div>
</section>

<section class="bg-white py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Know, WHAT WE DO?</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                MNA Cap a Secure Cryptocurrency Trading Company its Infrastructure Facilitates Investment in the Cryptocurrencies industry with Daily Profit Growth on Investment.
            </p>
        </div>

        <div class="mb-12 text-center">
            <p class="text-lg text-gray-700 max-w-3xl mx-auto">
                B4U is group of people who have large experience of trading, investment tricks and market scope. 
                By using their skills and expertise we trade your investment in the market and earn profit.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-orange-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-orange-800 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Investment in Property Deals</h3>
            </div>

            <div class="bg-orange-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-orange-800 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Investment in Crypto Exchange</h3>
            </div>

            <div class="bg-orange-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-orange-800 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Investment in Information Technologies</h3>
            </div>

            <div class="bg-orange-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-orange-800 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Invest in NFT's</h3>
            </div>

            <div class="bg-orange-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-orange-800 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Investment in Trading</h3>
            </div>

            <div class="bg-orange-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-orange-800 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Investment in Commodities</h3>
            </div>
        </div>
    </div>
</section>



<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Left Column - Image -->
            <div class="rounded-xl overflow-hidden">
                <img src="https://images.pexels.com/photos/844124/pexels-photo-844124.jpeg" alt="Why Choose Us" class="w-full h-auto object-cover">
            </div>

            <!-- Right Column - Content -->
            <div>
                <h2 class="text-3xl font-bold mb-12">Why Choose Us?</h2>
                <div class="space-y-8">
                    <div class="flex items-start gap-4">
                        <div class="text-orange-800 flex-shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Proven Expertise</h3>
                            <p class="text-gray-600">Our experts have years of experience in the investment world, with a deep understanding of market trends and the tools needed to succeed.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="text-orange-800 flex-shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Data-Driven Decisions</h3>
                            <p class="text-gray-600">We rely on cutting-edge analytics and market research to guide our investment strategies, ensuring optimal returns and minimal risk.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="text-orange-800 flex-shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Trusted by Clients</h3>
                            <p class="text-gray-600">With a growing list of satisfied clients, we have built a reputation for reliability, transparency, and consistent results.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="text-orange-800 flex-shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Sustainable Growth</h3>
                            <p class="text-gray-600">We focus not just on short-term profits but on building sustainable wealth for the long run.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-2">Testimonials</h2>
        <p class="text-xl text-center text-gray-600 mb-12">What Our Clients Are Saying</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex flex-col h-full">
                    <div class="flex-grow">
                        <div class="text-orange-500 mb-4">★★★★★</div>
                        <h4 class="text-xl font-semibold mb-4">"A Game-Changer for My Finances!"</h4>
                        <p class="text-gray-600 mb-6">"Investing with MNA Cap Digital has been the best decision I've ever made. In just a few months, I've seen consistent returns that exceeded my expectations. The team is professional, transparent, and always available to answer questions. Highly recommended!"</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold text-gray-800">Sarah L.</p>
                        <p class="text-gray-600">Manager</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex flex-col h-full">
                    <div class="flex-grow">
                        <div class="text-orange-500 mb-4">★★★★★</div>
                        <h4 class="text-xl font-semibold mb-4">"Reliable Profits, Stress-Free Experience."</h4>
                        <p class="text-gray-600 mb-6">"As someone new to cryptocurrency, I was hesitant to invest. But MNA Cap Digital made it simple and secure. Their guidance and regular updates gave me peace of mind, and I'm thrilled with the steady profits I've earned. It's great to have a platform I can trust."</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold text-gray-800">James R.</p>
                        <p class="text-gray-600">Civil Engineer</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex flex-col h-full">
                    <div class="flex-grow">
                        <div class="text-orange-500 mb-4">★★★★★</div>
                        <h4 class="text-xl font-semibold mb-4">"A Partner I Can Trust."</h4>
                        <p class="text-gray-600 mb-6">"I've been investing with MNA Cap Digital for over a year, and the results speak for themselves. The platform is easy to use, and their team's expertise ensures that my investments are in the right hands. I've referred my friends and family, and they're just as satisfied."</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold text-gray-800">Ali K.</p>
                        <p class="text-gray-600">Banker</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial 4 -->
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex flex-col h-full">
                    <div class="flex-grow">
                        <div class="text-orange-500 mb-4">★★★★★</div>
                        <h4 class="text-xl font-semibold mb-4">"From Skeptic to Believer."</h4>
                        <p class="text-gray-600 mb-6">"At first, I was skeptical about online investment platforms. But MNA Cap Digital proved me wrong. Their transparency, regular updates, and impressive returns made me a believer. I'm excited to keep growing my portfolio with them!"</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold text-gray-800">Maria D.</p>
                        <p class="text-gray-600">Teacher</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial 5 -->
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex flex-col h-full">
                    <div class="flex-grow">
                        <div class="text-orange-500 mb-4">★★★★★</div>
                        <h4 class="text-xl font-semibold mb-4">"Unmatched Expertise and Results!"</h4>
                        <p class="text-gray-600 mb-6">"I've tried multiple investment platforms, but nothing compares to MNA Cap Digital. The insights and strategies they offer are top-notch, and my portfolio has grown consistently over the past year. This platform is a must for anyone serious about making their money work for them."</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold text-gray-800">Raj M.</p>
                        <p class="text-gray-600">Software Developer</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial 6 -->
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex flex-col h-full">
                    <div class="flex-grow">
                        <div class="text-orange-500 mb-4">★★★★★</div>
                        <h4 class="text-xl font-semibold mb-4">"A Secure Path to Financial Growth."</h4>
                        <p class="text-gray-600 mb-6">"Security was my biggest concern when I started investing, but MNA Cap Digital has proven to be trustworthy. Their transparent approach and focus on investor safety have given me confidence, and the profits have been amazing. Thank you for helping me secure my financial future!"</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold text-gray-800">Hiba A.</p>
                        <p class="text-gray-600">House wife</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="py-16 bg-orange-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Commission Structure</h2>
        <div class="flex flex-wrap justify-center">
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow m-4 w-full md:w-1/2">
                <h3 class="text-xl font-semibold mb-4">1% Commission on Each Referral</h3>
                <p class="text-gray-700 mb-6">This means you will provide the referrer (the person who made the referral) a one-time commission equal to 1% of the total value of the referral.</p>
            </div>
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow m-4 w-full md:w-1/2">
                <h3 class="text-xl font-semibold mb-4">5% Commission on Referral's Daily Profit</h3>
                <p class="text-gray-700">This is an ongoing incentive where the referrer earns 5% of the daily profit generated by their referral.</p>
            </div>
        </div>
        <p class="text-gray-700 mt-6">This dual-commission structure can be attractive because it provides both an upfront reward (1%) and a continuous, performance-based income stream (5%).</p>
    </div>
</section><footer class="bg-orange-900 py-8">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h3 class="text-2xl font-bold text-orange-100 mb-4">Take Control of Your Financial Future Today</h3>
            <p class="text-orange-100 mb-6">Ready to start maximizing your investment returns? Let's talk. Our team will work with you to understand your financial goals and develop a customized plan that aligns with your vision.</p>
            <a href="#contact" class="inline-block bg-orange-500 text-white px-8 py-3 rounded-lg hover:bg-orange-600 transition-colors">Contact Us</a>
        </div>
        <div class="text-center text-orange-100 mt-8">
            <p>MNA Cap © 2024. All rights reserved</p>
        </div>
    </div>
</footer>

  
    </body>
</html>