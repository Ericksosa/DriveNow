<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DriveNow - Alquiler de coches fácil, a tu manera</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=poppins:400,500,600,700&display=swap"
        rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/x-icon">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Updated to Rentcars-inspired design with coastal road background */
        .hero-bg {
            background: linear-gradient(135deg, rgba(0, 102, 204, 0.4), rgba(0, 51, 102, 0.5)),
                url('/images/utilities/main-banner.webp') center/cover;
            min-height: 100vh;
        }

        .search-form {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .btn-search {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-1px);
        }

        .feature-badge {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .trust-badge {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        /* Added automotive brand colors */
        .brand-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 2rem;
            align-items: center;
        }
    </style>
</head>

<body class="antialiased font-inter bg-white text-gray-900">
    <!-- Updated navigation to match Rentcars style -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/10 backdrop-blur-md border-b border-white/20">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-white">
                        <span class="text-blue-400">Drive</span><span class="text-orange-400">Now</span>
                    </h1>
                </div>

                <!-- Navigation Items -->
                <div class="hidden md:flex items-center space-x-6">
                    <div class="flex items-center space-x-2 text-white/80">
                        <img src="/placeholder.svg?height=20&width=30" alt="ES" class="w-5 h-3">
                        <span class="text-sm">ES</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>

                    <div class="flex items-center space-x-2 text-white/80">
                        <span class="text-sm">DOP</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>

                    <a href="#" class="text-white/80 hover:text-white transition-colors text-sm">
                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        Ayuda
                    </a>
                </div>

                <!-- Auth Links -->
                @if (Route::has('login'))
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route(strtolower(Auth::user()->roles->first()->name) . '.dashboard') }}"
                                class="px-6 py-2 rounded-lg font-semibold text-white bg-white/20 backdrop-blur-sm hover:bg-white/30 transition-all duration-300">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="px-6 py-2 rounded-lg font-semibold text-white bg-red-500 backdrop-blur-sm hover:bg-red-600 transition-all duration-300">
                                    Cerrar Sesión
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-6 py-2 rounded-lg font-semibold text-white hover:bg-white/20 backdrop-blur-sm transition-all duration-300 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Iniciar sesión
                            </a>
                            <a href="{{ route('register') }}"
                                class="px-6 py-2 rounded-lg font-semibold text-white hover:bg-white/20 backdrop-blur-sm transition-all duration-300 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Registrarse
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section with integrated search form like Rentcars -->
    <section class="hero-bg flex items-center justify-center text-white pt-20">
        <div class="max-w-6xl mx-auto px-6 py-20">
            <div class="text-center mb-12">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 text-balance font-poppins">
                    Tu viaje comienza aquí<br> con nosotros.
                </h1>
                <p class="text-xl md:text-2xl text-white/90 max-w-2xl mx-auto text-pretty">
                    Conectándote a las mejores experiencias a los mejores precios
                </p>
            </div>

            <!-- Search Form inspired by Rentcars -->
            <div class="search-form p-8 max-w-5xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <!-- Pickup Location -->
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Recogida</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <input type="text" placeholder="Buscar destinos"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <p class="text-sm text-blue-600 mt-1">+ Devolución en otra ubicación</p>
                    </div>

                    <!-- Pickup Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de recogida</label>
                        <input type="date" value="2025-09-21"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-sm text-gray-500 mt-1">Hora: 10:00</p>
                    </div>

                    <!-- Return Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Devolución</label>
                        <input type="date" value="2025-09-22"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-sm text-gray-500 mt-1">Hora: 10:00</p>
                    </div>

                    <!-- Search Button -->
                    <div class="flex items-end">
                        @guest
                            <a href="{{ route('register') }}"
                                class="btn-search w-full px-6 py-4 rounded-lg text-lg font-semibold text-center block">
                                Buscar
                            </a>
                        @else
                            <a href="{{ route(strtolower(Auth::user()->roles->first()->name) . '.dashboard') }}"
                                class="btn-search w-full px-6 py-4 rounded-lg text-lg font-semibold text-center block">
                                Buscar
                            </a>
                        @endguest
                    </div>
                </div>

                <!-- Residence Selector -->
                <div class="flex items-center text-sm text-gray-600">
                    <span class="mr-2">Residencia:</span>
                    <img src="/placeholder.svg?height=16&width=24" alt="RD" class="w-4 h-3 mr-2">
                    <span class="font-medium">República Dominicana</span>
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>

            <!-- Feature badges like Rentcars -->
            <div class="grid md:grid-cols-3 gap-6 mt-12 max-w-4xl mx-auto">
                <div class="feature-badge rounded-lg p-4 text-center">
                    <svg class="w-6 h-6 text-orange-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-white text-sm">Compara más de 300 compañías en todo el mundo</p>
                </div>
                <div class="feature-badge rounded-lg p-4 text-center">
                    <svg class="w-6 h-6 text-orange-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-white text-sm">Descuentos exclusivos</p>
                </div>
                <div class="feature-badge rounded-lg p-4 text-center">
                    <svg class="w-6 h-6 text-orange-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-white text-sm">Cashback para tu próximo alquiler</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Section like Rentcars -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center mb-8 md:mb-0">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mr-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Explora tu destino con confianza</h3>
                        <p class="text-gray-600">Miles de personas confían en DriveNow para viajar por el mundo.</p>
                    </div>
                </div>

                <div class="trust-badge rounded-lg p-6 text-center">
                    <div class="flex items-center justify-center mb-2">
                        <span class="text-green-600 font-bold text-lg mr-2">★</span>
                        <span class="text-2xl font-bold text-gray-900">Trustpilot</span>
                    </div>
                    <div class="flex items-center justify-center mb-1">
                        <span class="text-3xl font-bold text-gray-900">4.5</span>
                        <div class="flex ml-2">
                            <span class="text-green-500">★★★★★</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">157,270 Valoraciones • Excelente</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Car Showcase Section with better vehicle display -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4 font-poppins">Nuestra Flota Premium</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Descubre nuestra selección de vehículos de alta calidad para cada ocasión
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Car 1 - Economy -->
                <div
                    class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="relative">
                        <img src="/placeholder.svg?height=200&width=350" alt="Nissan Versa"
                            class="w-full h-48 object-cover">
                        <div
                            class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Económico
                        </div>
                        <div
                            class="absolute top-4 right-4 bg-blue-600 text-white px-2 py-1 rounded text-xs font-semibold">
                            ⭐ 4.8
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2 font-poppins">Nissan Versa</h3>
                        <p class="text-gray-600 mb-4">Perfecto para la ciudad. Económico y confiable.</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    5 asientos
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-orange-500" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z">
                                        </path>
                                    </svg>
                                    Manual
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">$25</span>
                                <span class="text-gray-500">/día</span>
                            </div>
                            @guest
                                <a href="{{ route('register') }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                    Reservar
                                </a>
                            @else
                                <a href="{{ route(strtolower(Auth::user()->roles->first()->name) . '.dashboard') }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                    Reservar
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>

                <!-- Car 2 - SUV -->
                <div
                    class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="relative">
                        <img src="/placeholder.svg?height=200&width=350" alt="Toyota RAV4"
                            class="w-full h-48 object-cover">
                        <div
                            class="absolute top-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            SUV
                        </div>
                        <div
                            class="absolute top-4 right-4 bg-blue-600 text-white px-2 py-1 rounded text-xs font-semibold">
                            ⭐ 4.9
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2 font-poppins">Toyota RAV4</h3>
                        <p class="text-gray-600 mb-4">Espacioso y versátil para aventuras familiares.</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    7 asientos
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-orange-500" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z">
                                        </path>
                                    </svg>
                                    Automático
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">$45</span>
                                <span class="text-gray-500">/día</span>
                            </div>
                            @guest
                                <a href="{{ route('register') }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                    Reservar
                                </a>
                            @else
                                <a href="{{ route(strtolower(Auth::user()->roles->first()->name) . '.dashboard') }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                    Reservar
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>

                <!-- Car 3 - Luxury -->
                <div
                    class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="relative">
                        <img src="/placeholder.svg?height=200&width=350" alt="BMW Serie 3"
                            class="w-full h-48 object-cover">
                        <div
                            class="absolute top-4 left-4 bg-gradient-to-r from-purple-600 to-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Lujo
                        </div>
                        <div
                            class="absolute top-4 right-4 bg-blue-600 text-white px-2 py-1 rounded text-xs font-semibold">
                            ⭐ 5.0
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2 font-poppins">BMW Serie 3</h3>
                        <p class="text-gray-600 mb-4">Elegancia y performance para ocasiones especiales.</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    5 asientos
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-orange-500" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z">
                                        </path>
                                    </svg>
                                    Automático
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">$85</span>
                                <span class="text-gray-500">/día</span>
                            </div>
                            @guest
                                <a href="{{ route('register') }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                    Reservar
                                </a>
                            @else
                                <a href="{{ route(strtolower(Auth::user()->roles->first()->name) . '.dashboard') }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                    Reservar
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call-to-action for viewing more cars -->
            <div class="text-center mt-12">
                @guest
                    <p class="text-gray-600 mb-6">¿Quieres ver más vehículos y precios especiales?</p>
                    <a href="{{ route('register') }}"
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold inline-block hover:bg-blue-700 transition-colors">
                        Registrarse para Ver Más
                    </a>
                @else
                    <a href="{{ route(strtolower(Auth::user()->roles->first()->name) . '.dashboard') }}"
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold inline-block hover:bg-blue-700 transition-colors">
                        Ver Toda la Flota
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Global Brands Section like Rentcars -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4 font-poppins">Más de 300 marcas globales de
                        alquiler de coches</h2>
                    <p class="text-gray-600 max-w-2xl">Compara los mejores precios y elige el coche perfecto para
                        alquilar, sin importar a dónde vayas</p>
                </div>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold mt-4 md:mt-0">Ver todas las
                    compañías →</a>
            </div>

            <!-- Brand Logos Grid -->
            <div class="brand-grid">
                <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-center h-16">
                    <span class="text-red-600 font-bold text-xl">AVIS</span>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-center h-16">
                    <span class="text-orange-500 font-bold text-xl">Budget</span>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-center h-16">
                    <span class="text-blue-600 font-bold text-xl">Alamo</span>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-center h-16">
                    <span class="text-green-600 font-bold text-xl">Europcar</span>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-center h-16">
                    <span class="text-yellow-600 font-bold text-xl">Hertz</span>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-center h-16">
                    <span class="text-green-700 font-bold text-xl">Enterprise</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4 font-poppins">
                        <span class="text-blue-400">Drive</span><span class="text-orange-400">Now</span>
                    </h3>
                    <p class="text-gray-300">
                        Tu compañía de confianza para alquiler de vehículos seguros y confiables.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 font-poppins">Servicios</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Alquiler
                                Diario</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Alquiler
                                Mensual</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Vehículos de
                                Lujo</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 font-poppins">Soporte</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Centro de
                                Ayuda</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Contacto</a>
                        </li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 font-poppins">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Términos</a>
                        </li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Privacidad</a>
                        </li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Cookies</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p>&copy; 2024 RentCars. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>

</html>
