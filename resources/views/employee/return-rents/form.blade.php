<!-- Aquí va el contenido del formulario -->
<div class="space-y-2 flex-grow">
    <!-- Campo Customer Id -->
    <div>
        <label for="customer_id"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Cliente') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <select name="customer_id" id="customer_id"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>{{ __('Seleccionar Cliente') }}</option>
                @forelse ($customers as $customer)
                    <option value="{{ $customer->id }}"
                        {{ $customer->id == old('customer_id', isset($returnAndRent) ? $returnAndRent->customer_id : '') ? 'selected' : '' }}>
                        {{ $customer->user->name . ' ' . $customer->user->last_name }}
                    </option>
                @empty
                    <option value="" disabled>{{ __('Clientes no disponibles') }}</option>
                @endforelse
            </select>
        </div>
    </div>
    <!-- Campo ReturnRent -->
    <div>
        <label for="total_amount"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Monto por día') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="number" step="0.01"
                value="{{ old('total_amount', isset($returnAndRent) ? $returnAndRent->total_amount : '') }}"
                name="total_amount" id="total_amount"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: RD$1500') }}">
        </div>
    </div>
    <!-- Campo Comments -->
    <label for="comments"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Comentarios') }}</label>
    <textarea id="comments" name="comments" rows="4"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="{{ __('Escribe los comentarios...') }}">{{ old('comments', isset($returnAndRent) ? $returnAndRent->comments : '') }}
    </textarea>
</div>
<div class="space-y-2 flex-grow">
    <!-- Campo Vehicle Id -->
    <div>
        <label for="vehicle_id"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Vehículo') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <select name="vehicle_id" id="vehicle_id"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>{{ __('Seleccionar Vehículo') }}</option>
                @forelse ($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}"
                        {{ $vehicle->id == old('vehicle_id', isset($returnAndRent) ? $returnAndRent->vehicle_id : '') ? 'selected' : '' }}>
                        {{ $vehicle->name }}
                    </option>
                @empty
                    <option value="" disabled>{{ __('Vehículos no disponibles') }}</option>
                @endforelse
            </select>
        </div>
    </div>
    <!-- Campo Return Date -->
    <div>
        <label for="rent_date"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Fecha de renta') }}</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
            </div>
            <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" type="text"
                value="{{ old('rent_date') ?? (isset($returnAndRent) ? $returnAndRent->rent_date : '') }}"
                name="rent_date" id="rent_date"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Fecha de Renta') }}">
        </div>
    </div>
    <!-- Campo Return Date -->
    <div>
        <label for="return_date"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Fecha de retorno') }}</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
            </div>
            <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" type="text"
                value="{{ old('return_date') ?? (isset($returnAndRent) ? $returnAndRent->return_date : '') }}"
                name="return_date" id="return_date"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Fecha de retorno') }}">
        </div>
    </div>
    <!-- Campo Vehicle Status -->
    <div>
        <label for="status"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Estado') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <select name="status" id="status"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>{{ __('Seleccionar Estado del Vehículo') }}</option>
                @forelse ($statuses as $value => $status)
                    <option value="{{ $value }}"
                        {{ $value == old('status', isset($returnAndRent) ? $returnAndRent->status : '') ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @empty
                    <option value="" disabled>{{ __('Estados no disponibles') }}</option>
                @endforelse
            </select>
        </div>
    </div>
</div>
