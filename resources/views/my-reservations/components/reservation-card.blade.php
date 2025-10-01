<div
    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-md transition-all duration-200 overflow-hidden">
    <div class="p-6">
        <div class="flex items-start justify-between mb-4">
            <div class="flex items-center space-x-4">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-600 rounded-xl flex items-center justify-center overflow-hidden">
                    @if ($reservation->vehicle)
                        <img src="{{ $reservation->vehicle->getFirstMediaUrl('vehicle_images') }}"
                            alt="{{ $reservation->vehicle->name }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-8 h-8 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    @endif
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">
                        {{ $reservation->vehicle->name }}</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400">{{ $reservation->vehicle->category }} •
                        {{ $reservation->vehicle->launching_year }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Reserva #{{ $reservation->id }}</p>
                </div>
            </div>

            @php
                $statusConfig = [
                    'Pendiente de aprobación' => [
                        'bg' => 'bg-amber-100 dark:bg-amber-900',
                        'text' => 'text-amber-800 dark:text-amber-300',
                        'label' => 'Pendiente',
                    ],
                    'Reservado' => [
                        'bg' => 'bg-blue-100 dark:bg-blue-900',
                        'text' => 'text-blue-800 dark:text-blue-300',
                        'label' => 'Reservado',
                    ],
                    'Devuelto' => [
                        'bg' => 'bg-slate-100 dark:bg-slate-700',
                        'text' => 'text-slate-800 dark:text-slate-300',
                        'label' => 'Devuelto',
                    ],
                    'Cancelado' => [
                        'bg' => 'bg-red-100 dark:bg-red-900',
                        'text' => 'text-red-800 dark:text-red-300',
                        'label' => 'Cancelado',
                    ],
                ];
                $status = $statusConfig[$reservation->status] ?? $statusConfig['Pendiente de aprobación'];
            @endphp

            <span
                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $status['bg'] }} {{ $status['text'] }}">
                {{ $status['label'] }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a1 1 0 01-1 1H5a1 1 0 01-1-1V8a1 1 0 011-1h3z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide">Inicio</p>
                    <p class="text-sm font-medium text-slate-900 dark:text-slate-100">
                        {{ $reservation->rent_date->format('d M Y') }}</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400">{{ $reservation->rent_date->format('H:i') }}
                    </p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide">Fin</p>
                    <p class="text-sm font-medium text-slate-900 dark:text-slate-100">
                        {{ $reservation->return_date->format('d M Y') }}</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400">
                        {{ $reservation->return_date->format('H:i') }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide">Total</p>
                    <p class="text-lg font-bold text-slate-900 dark:text-slate-100">
                        ${{ number_format($reservation->total_amount, 2) }}</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400">
                        {{ $reservation->rent_date->diffInDays($reservation->return_date) }} días</p>
                </div>
            </div>
        </div>

        @if ($reservation->ratings && $reservation->ratings->comment)
            <div class="bg-slate-50 dark:bg-slate-700 rounded-lg p-3 mb-4">
                @if ($reservation->ratings && $reservation->ratings->comment)
                    <div class="bg-slate-50 dark:bg-slate-700 rounded-lg p-3 mb-4">
                        <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide mb-1">Comentarios
                        </p>
                        <p class="text-sm text-slate-700 dark:text-slate-300">{{ $reservation->ratings->comment }}</p>

                        <!-- Contenedor de estrellas -->
                        <div class="flex flex-row items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $reservation->ratings->rating)
                                    <!-- Estrella llena -->
                                    <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @else
                                    <!-- Estrella vacía -->
                                    <svg class="w-5 h-5 text-gray-300 dark:text-gray-600" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endif
                            @endfor
                            <span class="ml-2 text-sm text-slate-700 dark:text-slate-300">
                                {{ $reservation->ratings->rating }} de 5 estrellas
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <div class="flex items-center justify-between pt-4 border-t border-slate-200 dark:border-slate-700">
            <div class="flex items-center space-x-2 text-xs text-slate-500 dark:text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Creada {{ $reservation->created_at->diffForHumans() }}</span>
            </div>

            <div class="flex items-center space-x-2">
                @if ($reservation->status === 'Pendiente de aprobación')
                <form action="{{ route('reservations.cancel', ['id' => $reservation->id]) }}" method="POST">
                    @csrf
                    <button
                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-700 dark:text-red-300 bg-red-100 dark:bg-red-900 rounded-lg hover:bg-red-200 dark:hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancelar
                    </button>
                </form>
                @elseif($reservation->status === 'Reservado')
                    <form action="{{ route('reservations.finalize', ['id' => $reservation->id]) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-purple-700 dark:text-purple-300 bg-purple-100 dark:bg-purple-900 rounded-lg hover:bg-purple-200 dark:hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Finalizar
                        </button>
                    </form>
                    <form action="{{ route('reservations.cancel', ['id' => $reservation->id]) }}" method="POST">
                        @csrf
                        <button
                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-700 dark:text-red-300 bg-red-100 dark:bg-red-900 rounded-lg hover:bg-red-200 dark:hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Cancelar
                        </button>
                    </form>
                @elseif($reservation->status === 'Cancelado')
                    @include('my-reservations.components.modal', [
                        'vehicleId' => $reservation->vehicle_id,
                        'customerId' => $reservation->customer_id,
                        'vehicleName' => $reservation->vehicle->name,
                        'rentId' => $reservation->id,
                        'hasRating' => $reservation->hasRating,
                    ])
                @elseif($reservation->status === 'Devuelto')
                    @include('my-reservations.components.modal', [
                        'vehicleId' => $reservation->vehicle_id,
                        'customerId' => $reservation->customer_id,
                        'vehicleName' => $reservation->vehicle->name,
                        'rentId' => $reservation->id,
                        'hasRating' => $reservation->hasRating,
                    ])
                @endif

                <a href="{{ route('reservations.show', ['id' => $reservation->id]) }}"
                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-900 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 transition-all">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Ver Detalles
                </a>
            </div>
        </div>
    </div>
</div>
