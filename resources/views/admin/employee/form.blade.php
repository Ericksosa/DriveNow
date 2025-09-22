<!-- Aquí va el contenido del formulario -->
<div class="space-y-2 flex-grow">
    <!-- Campo Employee Name -->
    <div>
        <label for="name"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Nombre(s)') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="text" value="{{ old('name', isset($employee) ? $employee->user->name : '') }}"
                name="name" id="name"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: John Doe') }}">
        </div>
    </div>
    <!-- Campo Employee last name -->
    <div>
        <label for="last_name"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Apellido(s)') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="text" value="{{ old('last_name', isset($employee) ? $employee->user->last_name : '') }}"
                name="last_name" id="last_name"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: John Doe') }}">
        </div>
    </div>
    <!-- Campo Employee email -->
    <div>
        <label for="email"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Correo') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="email" value="{{ old('email', isset($employee) ? $employee->user->email : '') }}"
                name="email" id="email"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: johndoe@email.com') }}">
        </div>
    </div>
    <!-- Campo Employee entry date -->
    <div>
        <label for="entry_date"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Fecha de Ingreso') }}</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
            </div>
            <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" type="text"
                value="{{ old('entry_date') ?? (isset($employee) ? $employee->entry_date : '') }}"
                name="entry_date" id="entry_date"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Fecha de ingreso del empleado') }}">
        </div>
    </div>
</div>
<div class="space-y-2 flex-grow">
    <!-- Campo Employee id card number -->
    <div>
        <label for="id_card_number"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Número de Cédula') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="text"
                value="{{ old('id_card_number', isset($employee) ? $employee->id_card_number : '') }}"
                name="id_card_number" id="id_card_number"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: 001-0001233-4') }}">
        </div>
    </div>
    <!-- Campo Employee shift -->
    <div>
        <label for="shift"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Tanda') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <select name="shift" id="shift"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled>{{ __('Seleccionar Tanda') }}</option>
                @forelse ($shifts as $value => $shift)
                    <option value="{{ $value }}"
                        {{ $value == old('shift', isset($employee) ? $employee->shift : '') ? 'selected' : '' }}>
                        {{ $shift }}
                    </option>
                @empty
                    <option value="" disabled>{{ __('Tandas no disponibles') }}</option>
                @endforelse
            </select>
        </div>
    </div>
    <!-- Campo Employee commission percentage -->
    <div>
        <label for="commission_percentage"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">{{ __('Porcentaje de Comisión') }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="number" step="0.01"
                value="{{ old('commission_percentage', isset($employee) ? $employee->commission_percentage : '') }}"
                name="commission_percentage" id="commission_percentage"
                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-black ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Ej: 10') }}">
        </div>
    </div>
    <!-- Campo Employee gender -->
    <div class="flex flex-col">
        <label class="mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">{{ __('Sexo') }}</label>
        <div class="flex">
            @foreach ($genders as $value => $gender_answer)
                <div class="flex items-center me-4">
                    <input id="sex-{{ $value }}" type="radio" value="{{ $value }}" name="gender"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        {{ old('gender') == $value || (isset($employee) && $value == $employee->user->gender) ? 'checked' : '' }}>
                    <label for="sex-{{ $value }}"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $gender_answer }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
