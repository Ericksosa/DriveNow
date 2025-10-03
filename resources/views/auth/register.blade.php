<x-guest-layout>
    <x-authentication-register-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-10">
                <!-- Columna 1 -->
                <div>
                    <x-label for="name" value="{{ __('Nombre(s)') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                </div>

                <div>
                    <x-label for="last_name" value="{{ __('Apellido(s)') }}" />
                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')"
                        required />
                </div>

                <div>
                    <x-label for="email" value="{{ __('Correo') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autocomplete="username" />
                </div>

                <div>
                    <x-label for="phone_number" value="{{ __('Número de Teléfono') }}" />
                    <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                        :value="old('phone_number')" required />
                </div>

                <div>
                    <x-label for="id_card_number" value="{{ __('Cédula') }}" />
                    <x-input id="id_card_number" class="block mt-1 w-full" type="text" name="id_card_number"
                        :value="old('id_card_number')" required />
                </div>

                <div>
                    <x-label for="credit_card_number" value="{{ __('Número de Tarjeta') }}" />
                    <x-input id="credit_card_number" class="block mt-1 w-full" type="text" name="credit_card_number"
                        :value="old('credit_card_number')" required />
                </div>

                <!-- Columna 2 -->
                <div>
                    <x-label for="password" value="{{ __('Contraseña') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div>
                    <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div>
                    <x-label for="gender" value="{{ __('Sexo') }}" />
                    <div class="flex items-center mt-2">
                        <label class="flex items-center mr-4">
                            <input type="radio" name="gender" value="Masculino" class="form-radio text-blue-600"
                                {{ old('gender') == 'Masculino' ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">{{ __('Masculino') }}</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="gender" value="Femenino" class="form-radio text-blue-600"
                                {{ old('gender') == 'Femenino' ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">{{ __('Femenino') }}</span>
                        </label>
                    </div>
                </div>

                <div>
                    <x-label for="person_type" value="{{ __('Tipo de Persona') }}" />
                    <div class="flex items-center mt-2">
                        <label class="flex items-center mr-4">
                            <input type="radio" name="person_type" value="Física" class="form-radio text-blue-600"
                                {{ old('person_type') == 'Física' ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">{{ __('Física') }}</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="person_type" value="Jurídica" class="form-radio text-blue-600"
                                {{ old('person_type') == 'Jurídica' ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">{{ __('Jurídica') }}</span>
                        </label>
                    </div>
                </div>

                <div>
                    <x-label for="driver_license_number" value="{{ __('Número de Licencia') }}" />
                    <x-input id="driver_license_number" class="block mt-1 w-full" type="text"
                        name="driver_license_number" :value="old('driver_license_number')" required />
                </div>

                <div>
                    <x-label for="driver_license_expiration_date" value="{{ __('Fecha de Expiración de la Licencia de Conducir') }}" />
                    <x-input id="driver_license_expiration_date" class="block mt-1 w-full" type="date"
                        name="driver_license_expiration_date" :value="old('driver_license_expiration_date')" required />
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    href="{{ route('login') }}">
                    {{ __('Ya posee cuenta?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Registrarse') }}
                </x-button>
            </div>
        </form>
    </x-authentication-register-card>
</x-guest-layout>
