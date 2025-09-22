<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">
            <span class="text-gray-900 dark:text-gray-200">{{ $title }}</span>
        </x-slot>
        <x-slot name="description">
            <span class="text-gray-600 dark:text-gray-400">{{ $description }}</span>
        </x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <span class="text-gray-900 dark:text-gray-200">
                {{ $content }}
            </span>
        </div>
    </div>
</div>