<x-nav-link href="{{ route('cliente.dashboard') }}" :active="request()->routeIs('cliente.dashboard')">
    {{ __('Inicio') }}
</x-nav-link>
<x-nav-link href="{{ route('showReservations') }}" :active="request()->routeIs('showReservations')">
    {{ __('Mis Reservas') }}
</x-nav-link>

<x-nav-link href="{{ route('vehicles-show-rent') }}" :active="request()->routeIs('vehicles-show-rent')">
    {{ __('Vehículos') }}
</x-nav-link>
