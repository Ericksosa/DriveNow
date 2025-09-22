<x-form-section submit="updatePassword">
    <x-slot name="title">
        <span class="text-gray-900 dark:text-gray-200">{{ __('Update Password') }}</span>
    </x-slot>

    <x-slot name="description">
        <span class="text-gray-600 dark:text-gray-400">{{ __('Ensure your account is using a long, random password to stay secure.') }}</span>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Current Password') }}" class="text-gray-900 dark:text-gray-200" />
            <x-input id="current_password" type="password" class="mt-1 block w-full text-gray-900 dark:text-gray-200 bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400"
                wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2 text-red-600 dark:text-red-400" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('New Password') }}" class="text-gray-900 dark:text-gray-200" />
            <x-input id="password" type="password" class="mt-1 block w-full text-gray-900 dark:text-gray-200 bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400"
                wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2 text-red-600 dark:text-red-400" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-gray-900 dark:text-gray-200" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full text-gray-900 dark:text-gray-200 bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400"
                wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2 text-red-600 dark:text-red-400" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3 text-gray-600 dark:text-gray-400" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>