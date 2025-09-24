<!-- Aquí va el contenido del formulario -->
<div class="space-y-2 flex-grow">
    <!-- Campo Fuel Type Name -->
    <div>
        <label for="name"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Nombre') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="text" value="{{ old('name', isset($vehicle) ? $vehicle->name : '') }}" name="name"
                id="name"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: Honda CRV LX 2025') }}">
        </div>
    </div>
    <!-- Campo Fuel Type description -->
    <label for="description"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Descripción') }}</label>
    <textarea id="description" name="description" rows="1"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="{{ __('Escribe la descripcion de los modelos de vehículos...') }}">{{ old('description', isset($vehicle) ? $vehicle->description : '') }}</textarea>
    <!-- Campo Chasis number -->
    <div>
        <label for="chasis_number"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Número de chásis') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="text" value="{{ old('chasis_number', isset($vehicle) ? $vehicle->chasis_number : '') }}"
                name="chasis_number" id="chasis_number"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: 1HGCM82633A123456') }}">
        </div>
    </div>
    <!-- Campo Engine Number -->
    <div>
        <label for="engine_number"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Número de motor') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="text" value="{{ old('engine_number', isset($vehicle) ? $vehicle->engine_number : '') }}"
                name="engine_number" id="engine_number"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: 4G63-1234567') }}">
        </div>
    </div>
    <!-- Campo PLate Number -->
    <div>
        <label for="plate_number"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Número de placa') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="text" value="{{ old('plate_number', isset($vehicle) ? $vehicle->plate_number : '') }}"
                name="plate_number" id="plate_number"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: A001122') }}">
        </div>
    </div>
    <!-- Campo Color -->
    <div>
        <label for="color"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Color') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="text" value="{{ old('color', isset($vehicle) ? $vehicle->color : '') }}" name="color"
                id="color"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: Azul') }}">
        </div>
    </div>
    <!-- Campo transmission -->
    <div>
        <label for="category"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Categoría de Vehículo') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <select name="category" id="category"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>{{ __('Seleccionar Categoría del Vehículo') }}</option>
                @forelse ($categories as $value => $transmission)
                    <option value="{{ $value }}"
                        {{ $value == old('transmission', isset($vehicle) ? $vehicle->transmission : '') ? 'selected' : '' }}>
                        {{ $transmission }}
                    </option>
                @empty
                    <option value="" disabled>{{ __('Categorias no disponibles') }}</option>
                @endforelse
            </select>
        </div>
    </div>
    <!-- Campo number of doors -->
    <div>
        <label for="number_of_doors"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Número de puertas') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="number"
                value="{{ old('number_of_doors', isset($vehicle) ? $vehicle->number_of_doors : '') }}"
                name="number_of_doors" id="number_of_doors"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: 4') }}">
        </div>
    </div>
    <!-- Campo transmission -->
    <div>
        <label for="transmission"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Categoría de Vehículo') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <select name="transmission" id="transmission"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>{{ __('Seleccionar Categoría del Vehículo') }}</option>
                @forelse ($transmissions as $value => $transmission)
                    <option value="{{ $value }}"
                        {{ $value == old('transmission', isset($vehicle) ? $vehicle->transmission : '') ? 'selected' : '' }}>
                        {{ $transmission }}
                    </option>
                @empty
                    <option value="" disabled>{{ __('Categorias no disponibles') }}</option>
                @endforelse
            </select>
        </div>
    </div>
</div>
<div class="space-y-2 flex-grow">

    <label for="launching_year"
        class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Año de lanzamiento') }}</label>
    <div class="relative mt-2 rounded-md shadow-sm">
        <select name="launching_year" id="launching_year"
            class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="" disabled selected>{{ __('Seleccionar Año de Lanzamiento') }}</option>
            @php
                $currentYear = date('Y') + 1; // Año actual + 1
            @endphp
            @for ($year = $currentYear; $year >= 1900; $year--)
                <option value="{{ $year }}"
                    {{ $year == old('year', isset($vehicle) ? $vehicle->launching_year : '') ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endfor
        </select>
    </div>
    <!-- Campo number of seats -->
    <div>
        <label for="number_of_seats"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Número de asientos') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="number"
                value="{{ old('number_of_seats', isset($vehicle) ? $vehicle->number_of_seats : '') }}"
                name="number_of_seats" id="number_of_seats"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: 4') }}">
        </div>
    </div>
    <!-- Campo amount per day -->
    <div>
        <label for="amount_per_day"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Monto por Día') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="number" step="0.01"
                value="{{ old('amount_per_day', isset($vehicle) ? $vehicle->amount_per_day : '') }}"
                name="amount_per_day" id="amount_per_day"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: 4000') }}">
        </div>
    </div>
    <!-- Campo Vehicle Type -->
    <div>
        <label for="vehicle_type_id"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Tipo de Vehículo') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <select name="vehicle_type_id" id="vehicle_type_id"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>{{ __('Seleccionar Tipo de Vehículo') }}</option>
                @forelse ($vehicleTypes as $vehicleType)
                    <option value="{{ $vehicleType->id }}"
                        {{ $vehicleType->id == old('vehicle_type_id', isset($vehicle) ? $vehicle->vehicle_type_id : '') ? 'selected' : '' }}>
                        {{ $vehicleType->name }}
                    </option>
                @empty
                    <option value="" disabled>{{ __('Tipos de Vehículos no disponibles') }}</option>
                @endforelse
            </select>
        </div>
    </div>
    <div>
        <label for="fuel_type_id"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Tipo de Combustible') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <select name="fuel_type_id" id="fuel_type_id"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>{{ __('Seleccionar Tipo de combustible') }}</option>
                @forelse ($fuelTypes as $fuelType)
                    <option value="{{ $fuelType->id }}"
                        {{ $fuelType->id == old('fuel_type_id', isset($vehicle) ? $vehicle->fuel_type_id : '') ? 'selected' : '' }}>
                        {{ $fuelType->name }}
                    </option>
                @empty
                    <option value="" disabled>{{ __('Tipos de Vehículos no disponibles') }}</option>
                @endforelse
            </select>
        </div>
    </div>
    <div>
        <label for="vehicle_model_id"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Modelo de Vehículo') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <select name="vehicle_model_id" id="vehicle_model_id"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>{{ __('Seleccionar Modelo de Vehículo') }}</option>
                @forelse ($vehicleModels as $vehicleModel)
                    <option value="{{ $vehicleModel->id }}"
                        {{ $vehicleModel->id == old('vehicle_model_id', isset($vehicle) ? $vehicle->vehicle_model_id : '') ? 'selected' : '' }}>
                        {{ $vehicleModel->name }}
                    </option>
                @empty
                    <option value="" disabled>{{ __('Modelos de Vehículos no disponibles') }}</option>
                @endforelse
            </select>
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
                        {{ $value == old('status', isset($vehicle) ? $vehicle->status : '') ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @empty
                    <option value="" disabled>{{ __('Estados no disponibles') }}</option>
                @endforelse
            </select>
        </div>
    </div>
    <div>
        <label for="logo" class="block mb-2 text-sm font-medium text-gray-300">Logo</label>
        <input type="file" id="logo" name="vehicle_image"
            class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
            onchange="previewLogo(event)">

        <div id="image-preview"
            class="mt-2 h-32 w-32 bg-slate-700 rounded-lg flex items-center justify-center relative">
            @if (isset($vehicle) && $vehicle->hasMedia('vehicle_images'))
                <img id="logo-image" src="{{ $vehicle->getFirstMediaUrl('vehicle_images') }}" alt="Logo"
                    class="h-full w-full object-contain rounded-lg">
                <button type="button" onclick="removeImage()"
                    class="absolute top-1 right-1 bg-red-500 text-white text-xs px-2 py-1 rounded">
                    Eliminar
                </button>
            @else
                <span class="text-gray-400">Vista Previa</span>
            @endif
        </div>

        <!-- Campo oculto para manejar la eliminación de la imagen -->
        <input type="hidden" name="remove_image" id="remove_image" value="0">
    </div>
</div>
<script>
    // Función para previsualizar la nueva imagen
    function previewLogo(event) {
        const imagePreview = document.getElementById('image-preview');
        const logoImage = document.getElementById('logo-image');

        // Si ya hay una imagen cargada, reemplázala
        if (logoImage) {
            logoImage.src = URL.createObjectURL(event.target.files[0]);
        } else {
            // Si no hay imagen, crea un nuevo elemento <img>
            const img = document.createElement('img');
            img.id = 'logo-image';
            img.src = URL.createObjectURL(event.target.files[0]);
            img.alt = 'Logo';
            img.className = 'h-full w-full object-contain rounded-lg';
            imagePreview.innerHTML = ''; // Limpia el contenedor
            imagePreview.appendChild(img);
        }

        // Asegúrate de que el campo oculto para eliminar la imagen esté en "0"
        document.getElementById('remove_image').value = '0';
    }

    // Función para eliminar la imagen actual
    function removeImage() {
        const imagePreview = document.getElementById('image-preview');
        const removeImageInput = document.getElementById('remove_image');

        // Limpia el contenedor de la imagen
        imagePreview.innerHTML = '<span class="text-gray-400">Vista Previa</span>';

        // Marca el campo oculto para indicar que se debe eliminar la imagen
        removeImageInput.value = '1';

        // Limpia el campo de entrada de archivo
        document.getElementById('logo').value = '';
    }
</script>
