<div>
    <!-- Filters and Search -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700 mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <!-- Search -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live='search' placeholder="Buscar reservas..."
                        class="block w-60 pl-10 pr-3 py-3 border border-slate-300 dark:border-slate-700 dark:text-gray-200 text-gray-900 rounded-xl leading-5 bg-white dark:bg-slate-900 placeholder-slate-500 dark:placeholder-slate-600 focus:outline-none focus:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm transition-all">
                </div>

                <!-- Status Filter -->
                <select wire:model.live="statusFilter"
                    class="block w-full px-3 py-3 border border-slate-300 dark:border-slate-700 rounded-xl bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm transition-all">
                    <option value="Todos">Todos los estados</option>
                    <option value="Pendiente de aprobación">Pendiente</option>
                    <option value="Reservado">Activa</option>
                    <option value="Devuelto">Completada</option>
                    <option value="Cancelado">Cancelada</option>
                </select>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('vehicles-show-rent') }}"
                    class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Nueva Reserva
                </a>
            </div>
        </div>
    </div>

    <!-- Reservations List -->
    <div class="space-y-6">
        @forelse($reservations as $reservation)
            @include('my-reservations.components.reservation-card', [
                'reservation' => $reservation,
            ])
        @empty
            <div
                class="bg-white dark:bg-slate-800 rounded-2xl p-12 shadow-sm border border-slate-200 dark:border-slate-700 text-center">
                <div
                    class="w-16 h-16 bg-slate-100 dark:bg-slate-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-slate-900 dark:text-slate-100 mb-2">No tienes reservas aún
                </h3>
                <p class="text-slate-600 dark:text-slate-400 mb-6">Comienza reservando tu primer vehículo</p>
                <button
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-medium hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Hacer Reserva
                </button>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($search == '')
        <div class="mt-4">
            {{ $reservations->links('pagination::tailwind') }}
        </div>
    @endif
</div>
