{{-- Modal de Reserva de Vehículo --}}
<div id="rentModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900/75 backdrop-blur-sm"
    aria-labelledby="modal-title" role="dialog" aria-modal="true">

    {{-- Modal Panel --}}
    <div
        class="relative transform overflow-hidden rounded-2xl bg-white px-6 pb-6 pt-8 text-left shadow-2xl transition-all sm:w-full sm:max-w-lg sm:px-8">

        {{-- Header --}}
        <div class="mb-8">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 mb-4">
                <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0 3 0m-3 0h3m-3 0V9a6 6 0 0 1 12 0v9.75m-3 0H9m1.5-12V6.75a4.5 4.5 0 0 1 9 0V9" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold leading-6 text-gray-900 text-center" id="modal-title">
                Reservar Vehículo
            </h3>
            <p class="mt-2 text-sm text-gray-500 text-center">
                Complete los datos para realizar su reserva
            </p>
        </div>

        {{-- Formulario --}}
        <form id="rentForm" method="POST" action="{{ route('storeReservation') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="vehicle_id" id="selectedVehicleId">

            {{-- Campo Vehículo --}}
            <div class="space-y-2">
                <label for="selectedVehicleName" class="block text-sm font-medium text-gray-900">
                    Vehículo seleccionado
                </label>
                <div class="relative">
                    <input type="text" id="selectedVehicleName"
                        class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 bg-gray-50 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                        readonly>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Fechas en Grid --}}
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                {{-- Fecha de Reserva --}}
                <div class="space-y-2">
                    <label for="rentDate" class="block text-sm font-medium text-gray-900">
                        Fecha de inicio
                    </label>
                    <input name="rent_date" type="date" id="rentDate"
                        class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                        required>
                </div>

                {{-- Fecha de Devolución --}}
                <div class="space-y-2">
                    <label for="returnDate" class="block text-sm font-medium text-gray-900">
                        Fecha de devolución
                    </label>
                    <input name="return_date" type="date" id="returnDate"
                        class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" min="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d')}}"
                        required>
                </div>
            </div>

            {{-- Información adicional --}}
            <div class="rounded-xl bg-blue-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-800">
                            <strong>Importante:</strong> Verifique las fechas antes de confirmar.
                            La reserva será guardada con las fechas seleccionadas inmediatamente.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Botones de Acción --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <button type="button" onclick="closeRentModal()"
                    class="inline-flex w-full justify-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 sm:w-auto">
                    Cancelar
                </button>
                <button type="submit"
                    class="inline-flex w-full justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed sm:w-auto">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Confirmar Reserva
                </button>
            </div>
        </form>
    </div>
</div>
@vite('resources/js/vehicles-show-rent.js')
