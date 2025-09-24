<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestionar Tipos de Combustibles') }}
        </h2>
    </x-slot>
    @livewire('fuel-type-search')
</x-app-layout>
