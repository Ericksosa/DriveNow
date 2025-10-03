<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RentCars - Nuestra Flota Completa</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=poppins:400,500,600,700&display=swap"
        rel="stylesheet" />

    <!-- Premium icon libraries and animations -->
    <script src="https://unpkg.com/heroicons@2.0.18/24/outline/index.js" type="module"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    @if (Session::has('success'))
        <meta name="sweet-alert-success" content="{{ Session::get('success') }}">
    @endif
    @if (Session::has('error'))
        <meta name="sweet-alert-error" content="{{ Session::get('error') }}">
    @endif
    @if (Session::has('warning'))
        <meta name="sweet-alert-warning" content="{{ Session::get('warning') }}">
    @endif
    @if ($errors->any())
        <meta name="sweet-alert-errors" content="{{ json_encode($errors->all()) }}">
    @endif
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/x-icon">


    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Updated color scheme to blue and orange for DriveNow branding */
        .filter-sidebar {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(59, 130, 246, 0.1);
        }

        .vehicle-card {
            transition: all 0.3s ease;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f5f9;
        }

        .vehicle-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
            border-color: #3b82f6;
        }

        .price-range-slider {
            -webkit-appearance: none;
            appearance: none;
            height: 4px;
            border-radius: 2px;
            background: #f97316;
            outline: none;
        }

        .price-range-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #3b82f6;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .filter-tag {
            background: rgb(26, 127, 251);
            color: white;
            padding: 0.375rem 0.75rem;
            border-radius: 16px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            margin: 0.25rem;
            transition: all 0.2s ease;
        }

        .search-header {
            background: linear-gradient(135deg, rgba(0, 102, 204, 0.4), rgba(0, 51, 102, 0.5)),
                url('/images/utilities/main-banner.webp') center/cover;
            min-height: 70vh;
        }

        .btn-primary {
            background: rgb(26, 127, 251);
            color: white;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: #f97316;
            transform: translateY(-1px);
        }

        .filter-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 50;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .filter-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .mobile-filter-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 40;
            background: #3b82f6;
            color: white;
            border-radius: 50%;
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            transition: all 0.2s ease;
        }

        .mobile-filter-btn:hover {
            transform: scale(1.05);
        }

        .mobile-filter-panel {
            position: fixed;
            top: 0;
            right: -100%;
            width: 90%;
            max-width: 400px;
            height: 100vh;
            background: white;
            z-index: 51;
            transition: right 0.3s ease;
            overflow-y: auto;
        }

        .mobile-filter-panel.active {
            right: 0;
        }
    </style>
</head>

<body class="antialiased font-inter bg-gray-50 text-gray-900">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-30 bg-white/98 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Updated logo to DriveNow branding -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2">
                        <h1 class="text-2xl font-bold text-gray-900">
                            <span class="text-blue-400">Drive</span><span class="text-orange-400">Now</span>
                        </h1>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ url('/') }}" class="text-gray-200 hover:text-gray-900 transition-colors">Inicio</a>
                    <a href="{{ route('vehicles-show-rent') }}"
                        class="text-gray-200 hover:text-gray-900 font-semibold">Vehículos</a>
                    <a href="{{ route('showReservations') }}"
                        class="text-gray-200 hover:text-gray-900 transition-colors">Mis Reservas</a>
                </div>

                <!-- Auth Links -->
                @if (Route::has('login'))
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/client/dashboard') }}"
                                class="btn-primary px-6 py-2 rounded-lg font-semibold flex items-center">
                                <i data-feather="grid" class="w-5 h-5 mr-2"></i>
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 rounded-lg font-medium text-gray-600 hover:text-gray-900 transition-all duration-300">
                                Registrarse
                            </a>
                            <a href="{{ route('login') }}"
                                class="btn-primary px-6 py-2 rounded-lg font-semibold flex items-center">
                                <i data-feather="user" class="w-5 h-5 mr-2"></i>
                                Iniciar sesión
                            </a>
                        @endauth
                    </div>
                @endif

                <!-- Mobile menu button -->
                <button class="md:hidden text-gray-600" onclick="toggleMobileMenu()">
                    <i data-feather="menu" class="w-6 h-6"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Search Header -->
    @include('vehicles-show-components.search-header')

    <!-- Main Content -->
    @include('vehicles-show-components.main-content')

    <!-- Mobile Filter Button -->
    <button class="mobile-filter-btn lg:hidden" onclick="toggleMobileFilters()">
        <i data-feather="filter" class="w-6 h-6"></i>
    </button>

    <!-- Mobile Filter Overlay -->
    <div id="filterOverlay" class="filter-overlay lg:hidden" onclick="toggleMobileFilters()"></div>


    <!-- Mobile Filter Panel -->
    @include('vehicles-show-components.mobile-filter-panel')
    @include('vehicles-show-components.modal')
    @vite('resources/js/vehicles-show-rent.js')
    <!-- Scripts de SweetAlert (mover aquí, no en <head>) -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    window.isAuthenticated = @json(auth()->check());
</body>
</html>

