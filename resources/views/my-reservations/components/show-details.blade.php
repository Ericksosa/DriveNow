<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalles del vehículo: ') . $vehicle->name }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Tarjeta Horizontal Principal -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="flex flex-col lg:flex-row">

                        <!-- Columna Izquierda - Imagen y Estado -->
                        <div class="lg:w-2/5 relative">
                            <div
                                class="h-full min-h-[400px] bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-600 relative">
                                @if ($vehicle->getFirstMediaUrl('vehicle_images'))
                                    <img src="{{ $vehicle->getFirstMediaUrl('vehicle_images') }}"
                                        alt="{{ $vehicle->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <svg class="w-32 h-32 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                @endif

                                @php
                                    $statusConfig = [
                                        'Excelente' => [
                                            'bg' => 'bg-green-500',
                                            'text' => 'text-white',
                                            'label' => 'Excelente',
                                        ],
                                        'Bueno' => [
                                            'bg' => 'bg-blue-500',
                                            'text' => 'text-white',
                                            'label' => 'Bueno',
                                        ],
                                        'Regular' => [
                                            'bg' => 'bg-amber-500',
                                            'text' => 'text-white',
                                            'label' => 'Regular',
                                        ],
                                        'Malo' => [
                                            'bg' => 'bg-red-500',
                                            'text' => 'text-white',
                                            'label' => 'Malo',
                                        ],
                                    ];

                                    // Configuración predeterminada si el estado no coincide con ninguno en $statusConfig
                                    $status = $statusConfig[$vehicle->status] ?? [
                                        'bg' => 'bg-gray-500',
                                        'text' => 'text-white',
                                        'label' => 'Desconocido',
                                    ];
                                @endphp

                                <!-- Badge de Estado -->
                                <div class="absolute top-6 left-6">
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $status['bg'] }} {{ $status['text'] }} shadow-lg backdrop-blur-sm">
                                        <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                                        {{ $status['label'] }}
                                    </span>
                                </div>

                                <!-- ID del Vehículo -->
                                <div
                                    class="absolute bottom-6 left-6 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm px-4 py-2 rounded-lg">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">ID Vehículo</p>
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">#{{ $vehicle->id }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Columna Derecha - Información Detallada -->
                        <div class="lg:w-3/5 p-8 overflow-y-auto max-h-[800px]">

                            <!-- Encabezado -->
                            <div class="mb-6">
                                <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                                    {{ $vehicle->name }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                                    {{ $vehicle->description ?? 'Sin descripción disponible' }}
                                </p>
                            </div>

                            <!-- Información Básica -->
                            <div class="mb-6">
                                <h4
                                    class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                                    <div class="w-1 h-4 bg-blue-500 rounded-full"></div>
                                    Información Básica
                                </h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Matrícula</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $vehicle->plate_number }}</p>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Color</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $vehicle->color }}</p>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Año de Lanzamiento</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $vehicle->launching_year }}</p>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Categoría</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $vehicle->category }}</p>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Modelo</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $vehicle->vehicleModel->name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-white/80 mb-1">Precio por Día</p>
                                        <p class="text-lg font-bold text-white">
                                            RD${{ number_format($vehicle->amount_per_day, 2) }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Especificaciones Técnicas -->
                            <div class="mb-6">
                                <h4
                                    class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                                    <div class="w-1 h-4 bg-purple-500 rounded-full"></div>
                                    Especificaciones Técnicas
                                </h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tipo de Vehículo</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $vehicle->vehicleType->name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tipo de Combustible</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $vehicle->fuelType->name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Transmisión</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ ucfirst($vehicle->transmission) }}</p>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Número de Puertas</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $vehicle->number_of_doors }}</p>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Número de Asientos</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $vehicle->number_of_seats }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Números de Identificación -->
                            <div class="mb-6">
                                <h4
                                    class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                                    <div class="w-1 h-4 bg-orange-500 rounded-full"></div>
                                    Números de Identificación
                                </h4>
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Número de Chasis</p>
                                        <p class="text-sm font-mono font-semibold text-gray-900 dark:text-white">
                                            {{ $vehicle->chasis_number }}</p>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Número de Motor</p>
                                        <p class="text-sm font-mono font-semibold text-gray-900 dark:text-white">
                                            {{ $vehicle->engine_number }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Información de Reserva -->
                            @if (isset($reservation))
                                <div class="mb-6">
                                    <h4
                                        class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                                        <div class="w-1 h-4 bg-green-500 rounded-full"></div>
                                        Detalles de la Reserva
                                    </h4>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div
                                            class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-3">
                                            <p class="text-xs text-green-600 dark:text-green-400 mb-1">Fecha de Renta
                                            </p>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ \Carbon\Carbon::parse($reservation->rent_date)->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                        <div
                                            class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-3">
                                            <p class="text-xs text-red-600 dark:text-red-400 mb-1">Fecha de Retorno</p>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ \Carbon\Carbon::parse($reservation->return_date)->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                        <div class="col-span-2 bg-slate-50 dark:bg-slate-700/50 rounded-lg p-4">
                                            <p class="text-xs dark:text-white/80 text-gray-900 mb-1">Monto Total de la
                                                Reserva</p>
                                            <p class="text-2xl font-bold dark:text-white text-gray-900">
                                                RD${{ number_format($reservation->total_amount, 2) }}</p>
                                            <p class="text-sm dark:text-white/80 text-gray-900 mt-1">
                                                {{ \Carbon\Carbon::parse($reservation->rent_date)->diffInDays(\Carbon\Carbon::parse($reservation->return_date)) }}
                                                días
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Información del Sistema -->
                            <div class="mb-6">
                                <h4
                                    class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                                    <div class="w-1 h-4 bg-slate-500 rounded-full"></div>
                                    Información del Sistema
                                </h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Fecha de Creación</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ \Carbon\Carbon::parse($vehicle->created_at)->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Última Actualización
                                        </p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ \Carbon\Carbon::parse($vehicle->updated_at)->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                    @if ($vehicle->deleted_at)
                                        <div
                                            class="col-span-2 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-3">
                                            <p class="text-xs text-red-600 dark:text-red-400 mb-1">Fecha de Eliminación
                                            </p>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ \Carbon\Carbon::parse($vehicle->deleted_at)->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Botón de Imprimir -->
                            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <button onclick="window.print()"
                                    class="w-full bg-slate-900 hover:bg-slate-800 dark:bg-slate-700 dark:hover:bg-slate-600 text-white font-semibold py-3 px-6 rounded-xl transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                    </svg>
                                    Imprimir Detalles
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Estilos para Impresión -->
    <style>
        @media print {
            @page {
                size: A4 portrait;
                /* Puedes usar A4, letter, o landscape */
                margin: 0;
            }

            body * {
                visibility: hidden;
            }

            .max-w-7xl,
            .max-w-7xl * {
                visibility: visible;
            }

            .max-w-7xl {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                transform: scale(1);
                /* Ajusta este valor según quepa todo */
                transform-origin: top left;
                /* page-break-inside: avoid; */
            }

            button,
            nav,
            header,
            footer,
            aside {
                display: none !important;
                /* Oculta menú, botones y demás */
            }
        }
    </style>
</x-app-layout>
