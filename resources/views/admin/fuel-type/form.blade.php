<!-- Aquí va el contenido del formulario -->
<div class="space-y-2 flex-grow">
    <!-- Campo Fuel Type Name -->
    <div>
        <label for="name"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Nombre') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="text" value="{{ old('name', isset($fuelType) ? $fuelType->name : '') }}" name="name"
                id="name"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: Gasolina') }}">
        </div>
    </div>
    <!-- Campo Fuel Type description -->
    <label for="description"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Descripción') }}</label>
    <textarea id="description" name="description" rows="2"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="{{ __('Escribe la descripcion del tipo de combustible...') }}">{{ old('description', isset($fuelType) ? $fuelType->description : '') }}</textarea>

</div>
