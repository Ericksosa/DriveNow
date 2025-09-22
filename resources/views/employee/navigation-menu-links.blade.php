<x-nav-link href="{{ route('empleado.dashboard') }}" :active="request()->routeIs('empleado.dashboard')">
    {{ __('Tablero') }}
</x-nav-link>
<x-nav-link href="{{ route('return-and-rents.index') }}" :active="request()->routeIs('return-and-rents.index')">
    {{ __('Rentas y Retornos') }}
</x-nav-link>

<x-nav-link href="{{ route('inspection.index') }}" :active="request()->routeIs('inspection.index')">
    {{ __('Inspecciones') }}
</x-nav-link>