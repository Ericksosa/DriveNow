<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @yield('form-title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto">
                    <form method="POST" action="@yield('form-action')" enctype="multipart/form-data"
                        class="bg-white dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        @csrf
                        @yield('form-method')

                        <h1 class="text-2xl font-bold mb-2 text-gray-900 dark:text-gray-200">@yield('form-title')</h1>
                        <p class="mb-4 text-gray-900 dark:text-gray-200">@yield('form-description')</p>

                        <div class="flex flex-wrap space-x-4">
                            @yield('form-content')
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button id="submit-button"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 focus:outline-none focus:shadow-outline"
                                type="submit">
                                {{__('Guardar')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
