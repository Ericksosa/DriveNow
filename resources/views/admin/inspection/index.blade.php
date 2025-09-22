<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestionar Inspecciones') }}
        </h2>
    </x-slot>
    <div>
        <div class="py-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                            {{ __('Tabla Gestión de Inspecciones') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ __('Aqui puedes gestionar las inspecciones. Crear, Editar y Eliminar') }}</p>
                    </div>
                    <div class="flex relative">
                        <input wire:model.live="search" type="text" name="search" placeholder="{{ __('Buscar...') }}"
                            class="px-4 py-2 pl-10 rounded dark:bg-gray-800 dark:text-white placeholder-gray-400 w-full">
                        <span class="absolute left-2 top-2 text-gray-400">
                            <i class="fas fa-search"></i>
                        </span>
                        <a href="{{ route('inspection.create') }}"
                            class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700 ml-2">
                            {{ __('Crear') }}
                        </a>
                        <a href="#" id="import_button"
                            class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700 ml-2 flex items-center">
                            <i class="bi bi-filetype-xlsx mr-2"></i>
                            {{ __('Importar') }}
                        </a>
                        <a href="{{ '' }}" id="export_button"
                            class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-700 ml-2 flex items-center">
                            <i class="bi bi-filetype-xlsx mr-2"></i>
                            {{ __('Exportar') }}
                        </a>
                        <form method="POST" action="{{ '' }}" enctype="multipart/form-data" id="import_form"
                            style="display: none;">
                            @csrf
                            <input type="file" name="document_csv" id="document_csv" style="display: none;"
                                onchange="document.getElementById('import_form').submit();">
                        </form>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <!-- Aquí están tus encabezados de tabla -->
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('ID') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('Descripción del vehículo') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('Cliente') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('Tiene rayaduras?') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('Cantidad de combustible') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('Tiene llanta de repuesto?') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('Tiene gato hidraulico?') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('Tiene cristal roto?') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('Estado llanta izquierda delantera') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('Estado llanta derecha delantera') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('Estado llanta izquierda trasera') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('Estado llanta derecha trasera') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('Fecha de inspección') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('Empleado') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider border-b border-gray-300 dark:border-gray-700">
                                    {{ __('Acciones') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                            <!-- Solo muestra los campos más importantes -->
                            @forelse($inspections as $inspection)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        {{ $inspection->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        {{ $inspection->vehicle->description }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        {{ $inspection->customer->user->name . ' ' . $inspection->customer->user->last_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        {{ $inspection->has_scratches ? 'Sí' : 'No' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        {{ $inspection->fuel_level }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        {{ $inspection->has_spare_tire ? 'Sí' : 'No'}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        {{ $inspection->has_car_jack ? 'Sí' : 'No'}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        {{ $inspection->has_glass_breakage ? 'Sí' : 'No'}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        {{ $inspection->front_left_tire }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        {{ $inspection->front_right_tire }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        {{ $inspection->rear_left_tire }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        {{ $inspection->rear_right_tire }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        {{ $inspection->inspection_date }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        @if ($inspection->employee && $inspection->employee->user)
                                            {{ $inspection->employee->user->name . ' ' . $inspection->employee->user->last_name }}
                                        @else
                                            <span class="text-gray-500 italic">No asignado</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                        <a href="{{ route('inspection.edit', $inspection->id) }}"
                                            class="px-4 py-2 text-blue-500 hover:text-blue-700">
                                            {{ __('Editar') }}
                                        </a>
                                        <form method="POST"
                                            action="{{ route('inspection.destroy', ['inspection' => $inspection->id]) }}"
                                            style="display: inline;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 text-red-500 hover:text-red-700"
                                                data-confirm="¿Estás seguro de que deseas eliminar la inspección {{ $inspection->id }}?">
                                                {{ __('Eliminar') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-400"
                                        colspan="10">
                                        {{ __('No hay registros de inspecciones. Crea uno ahora.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="m-4">
                {{ $inspections->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
    <script>
        document.getElementById('import_button').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('document_csv').click();
        });
    </script>
</x-app-layout>
