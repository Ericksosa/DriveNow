<x-nav-link href="{{ route('administrador.dashboard') }}" :active="request()->routeIs('administrador.dashboard')">
    {{ __('Tablero') }}
</x-nav-link>
<x-nav-link href="{{ route('employee.index') }}" :active="request()->routeIs('employee.index')">
    {{ __('Empleados') }}
</x-nav-link>
<x-nav-link href="{{ route('fuel-type.index') }}" :active="request()->routeIs('fuel-type.index')">
    {{ __('Tipos de Combustibles') }}
</x-nav-link>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex z-10">
    <div x-data="{ open: false }" class="relative sm:flex">

        <!-- Botón principal -->
        <button @click="open = !open"
            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5
                   text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 hover:border-gray-300
                   focus:outline-none focus:text-gray-700 dark:focus:text-gray-100 focus:border-gray-300 transition duration-150 ease-in-out">
            {{ __('Vehiculos') }}
            <svg class="ml-2 h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown -->
        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute left-0 top-full mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50">

            <a href="{{ route('brand.index') }}"
                class="block px-4 py-2 text-sm text-gray-800 dark:text-gray-200 hover:bg-blue-500 hover:text-white">
                Marcas
            </a>
            <a href="{{ route('vehicle-type.index') }}"
                class="block px-4 py-2 text-sm text-gray-800 dark:text-gray-200 hover:bg-blue-500 hover:text-white">
                Tipos de Vehículos
            </a>
            <a href="{{ route('vehicle-model.index') }}"
                class="block px-4 py-2 text-sm text-gray-800 dark:text-gray-200 hover:bg-blue-500 hover:text-white">
                Modelos de Vehiculos
            </a>
            <a href="{{ route('vehicle.index') }}"
                class="block px-4 py-2 text-sm text-gray-800 dark:text-gray-200 hover:bg-blue-500 hover:text-white">
                Gestión de Vehículos
            </a>
        </div>
    </div>
</div>

