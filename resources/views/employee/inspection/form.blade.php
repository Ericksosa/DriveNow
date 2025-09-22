<!-- Aquí va el contenido del formulario -->
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
                        {{ $vehicle->id == old('vehicle_id', isset($inspection) ? $inspection->vehicle_id : '') ? 'selected' : '' }}>
                        {{ $vehicle->name }}
                    </option>
                @empty
                    <option value="" disabled>{{ __('Vehículos no disponibles') }}</option>
                @endforelse
            </select>
        </div>
    </div>
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
                        {{ $customer->id == old('customer_id', isset($inspection) ? $inspection->customer_id : '') ? 'selected' : '' }}>
                        {{ $customer->user->name . ' ' . $customer->user->last_name }}
                    </option>
                @empty
                    <option value="" disabled>{{ __('Clientes no disponibles') }}</option>
                @endforelse
            </select>
        </div>
    </div>
    <!-- Campo Fuel level -->
    <div>
        <label for="fuel_level"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Nivel de Combustible') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <select name="fuel_level" id="fuel_level"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>{{ __('Seleccionar Nivel de Combustible') }}</option>
                @forelse ($fuel_levels as $value => $fuel_level)
                    <option value="{{ $value }}"
                        {{ $value == old('fuel_level', isset($inspection) ? $inspection->fuel_level : '') ? 'selected' : '' }}>
                        {{ $fuel_level }}
                    </option>
                @empty
                    <option value="" disabled>{{ __('Niveles de combustibles no disponibles') }}</option>
                @endforelse
            </select>
        </div>
    </div>
    <!-- Campo inspection_date -->
    <div>
        <label for="inspection_date"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Fecha de inspección') }}</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
            </div>
            <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" type="text"
                value="{{ old('inspection_date') ?? (isset($inspection) ? $inspection->inspection_date : '') }}"
                name="inspection_date" id="inspection_date"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Fecha de inspección') }}">
        </div>
    </div>
</div>
<div class="space-y-6 flex-grow">
    <!-- Campo Inspection Estado Llanta Izquierda -->
    <div class="flex flex-col">
        <label
            class="mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">{{ __('Estado Llanta Izquierda Frontal') }}</label>
        <div class="flex">
            @foreach ($tireStatuses as $value => $tireStatus)
                <div class="flex items-center me-4">
                    <input id="tireStatus-{{ $value }}" type="radio" value="{{ $value }}"
                        name="front_left_tire"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        {{ old('front_left_tire') == $value || (isset($inspection) && $value == $inspection->front_left_tire) ? 'checked' : '' }}>
                    <label for="tireStatus-{{ $value }}"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $tireStatus }}</label>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Campo Inspection Estado Llanta Derecha -->
    <div class="flex flex-col">
        <label
            class="mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">{{ __('Estado Llanta Derecha Frontal') }}</label>
        <div class="flex">
            @foreach ($tireStatuses as $value => $tireStatus)
                <div class="flex items-center me-4">
                    <input id="tireStatus-{{ $value }}" type="radio" value="{{ $value }}"
                        name="front_right_tire"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        {{ old('front_right_tire') == $value || (isset($inspection) && $value == $inspection->front_right_tire) ? 'checked' : '' }}>
                    <label for="tireStatus-{{ $value }}"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $tireStatus }}</label>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Campo Inspection Estado Llanta Izquierda Trasera -->
    <div class="flex flex-col">
        <label
            class="mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">{{ __('Estado Llanta Izquierda Trasera') }}</label>
        <div class="flex">
            @foreach ($tireStatuses as $value => $tireStatus)
                <div class="flex items-center me-4">
                    <input id="tireStatus-{{ $value }}" type="radio" value="{{ $value }}"
                        name="rear_left_tire"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        {{ old('rear_left_tire') == $value || (isset($inspection) && $value == $inspection->rear_left_tire) ? 'checked' : '' }}>
                    <label for="tireStatus-{{ $value }}"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $tireStatus }}</label>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Campo Inspection Estado Llanta Derecha Trasera -->
    <div class="flex flex-col">
        <label
            class="mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">{{ __('Estado Llanta Derecha Trasera') }}</label>
        <div class="flex">
            @foreach ($tireStatuses as $value => $tireStatus)
                <div class="flex items-center me-4">
                    <input id="tireStatus-{{ $value }}" type="radio" value="{{ $value }}"
                        name="rear_right_tire"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        {{ old('rear_right_tire') == $value || (isset($inspection) && $value == $inspection->rear_right_tire) ? 'checked' : '' }}>
                    <label for="tireStatus-{{ $value }}"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $tireStatus }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="space-y-6 flex-grow">
    <!-- Campo Inspection has scratches -->
    <div class="flex flex-col">
        <label
            class="mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">{{ __('Tiene Rayaduras?') }}</label>
        <div class="flex">
            @foreach ($yesNo as $value => $yes_no)
                <div class="flex items-center me-4">
                    <input id="has_scratches-{{ $value }}" type="radio" value="{{ $value }}"
                        name="has_scratches"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ old('has_scratches') == $value || (isset($inspection) && $value == $inspection->has_scratches) ? 'checked' : '' }}>
                    <label for="has_scratches-{{ $value }}"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $yes_no }}</label>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Campo Inspection has_spare_tire -->
    <div class="flex flex-col">
        <label
            class="mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">{{ __('Tiene Llanta Pinchada?') }}</label>
        <div class="flex">
            @foreach ($yesNo as $value => $yes_no)
                <div class="flex items-center me-4">
                    <input id="has_spare_tire-{{ $value }}" type="radio" value="{{ $value }}"
                        name="has_spare_tire"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ old('has_spare_tire') == $value || (isset($inspection) && $value == $inspection->has_spare_tire) ? 'checked' : '' }}>
                    <label for="has_spare_tire-{{ $value }}"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $yes_no }}</label>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Campo Inspection has_car_jack -->
    <div class="flex flex-col">
        <label
            class="mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">{{ __('Tiene Gato Hidráulico?') }}</label>
        <div class="flex">
            @foreach ($yesNo as $value => $yes_no)
                <div class="flex items-center me-4">
                    <input id="has_car_jack-{{ $value }}" type="radio" value="{{ $value }}"
                        name="has_car_jack"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ old('has_car_jack') == $value || (isset($inspection) && $value == $inspection->has_car_jack) ? 'checked' : '' }}>
                    <label for="has_car_jack-{{ $value }}"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $yes_no }}</label>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Campo Inspection has_glass_breakage -->
    <div class="flex flex-col">
        <label
            class="mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">{{ __('Tiene Cristal Roto?') }}</label>
        <div class="flex">
            @foreach ($yesNo as $value => $yes_no)
                <div class="flex items-center me-4">
                    <input id="has_glass_breakage-{{ $value }}" type="radio" value="{{ $value }}"
                        name="has_glass_breakage"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ old('has_glass_breakage') == $value || (isset($inspection) && $value == $inspection->has_glass_breakage) ? 'checked' : '' }}>
                    <label for="has_glass_breakage-{{ $value }}"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $yes_no }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
