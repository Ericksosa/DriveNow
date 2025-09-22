<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
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
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/x-icon">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased" x-data="{ darkMode: false }" x-init="darkMode = localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);
$watch('darkMode', val => {
    localStorage.setItem('theme', val ? 'dark' : 'light');
    if (val) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
})">
    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
            <button id="theme-toggle" @click="darkMode = !darkMode"
                class="fixed bottom-6 right-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-white rounded-full p-3 shadow-lg hover:shadow-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                sm:bottom-10 sm:right-4 md:bottom-8 md:right-4 lg:bottom-10 lg:right-4 xl:bottom-10 xl:right-16 z-50"
                aria-label="Toggle Dark Mode">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" :class="{ 'hidden': darkMode }" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" :class="{ 'hidden': !darkMode }" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </button>
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Pantalla de carga inicial -->
    <div id="page-loader"
        class="fixed inset-0 z-[9999] bg-white dark:bg-gray-900 flex items-center justify-center transition-opacity duration-300">
        <div class="flex flex-col items-center">
            <svg class="animate-spin h-12 w-12 text-blue-600 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            <p id="loader-message" class="text-gray-700 dark:text-gray-200 text-lg">
                Ya casi listo...
            </p>
        </div>
    </div>
    <script>
        const loadingMessages = @json(config('loader.messages'));
        const loader = document.getElementById('page-loader');
        const messageElement = document.getElementById('loader-message');

        window.addEventListener('beforeunload', () => {
            const randomMessage = loadingMessages[Math.floor(Math.random() * loadingMessages.length)];
            messageElement.textContent = randomMessage;
            loader.classList.remove('hidden');
        });

        window.addEventListener('load', () => {
            loader.classList.add('hidden');
        });
    </script>
</body>

</html>
