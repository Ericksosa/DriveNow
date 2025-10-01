<section class="py-8">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Simplified desktop filters with cleaner layout -->
            <div class="hidden lg:block w-72">
                <div class="filter-sidebar p-5 sticky top-32">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center">
                            <i data-feather="filter" class="w-5 h-5 mr-2 text-blue-600"></i>
                            Filtros
                        </h3>
                        <button onclick="clearAllFilters()"
                            class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            Limpiar
                        </button>
                    </div>

                    <!-- Active Filters -->
                    <div id="activeFilters" class="mb-5 hidden">
                        <div id="filterTags" class="flex flex-wrap"></div>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <i data-feather="dollar-sign" class="w-4 h-4 mr-2 text-orange-500"></i>
                            Precio por día
                        </h4>
                        <div class="space-y-3">
                            <input type="range" id="priceRange" min="20" max="25000" value="25000"
                                class="price-range-slider w-full">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>$20</span>
                                <span id="maxPrice">$25000</span>
                            </div>
                            <div class="text-center">
                                <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                    Hasta $<span id="selectedPrice">25000</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <i data-feather="grid" class="w-4 h-4 mr-2 text-blue-600"></i>
                            Categoría
                        </h4>
                        <div class="space-y-2">
                            @forelse($loadVehiclesCategories as $vehicleCategory)
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                    <input type="checkbox"
                                        class="category-filter rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                        value="{{ $vehicleCategory->category }}">
                                    <span class="ml-3 text-gray-700">{{ $vehicleCategory->category }}</span>
                                    <span class="ml-auto text-sm text-gray-500">({{ $vehicleCategory->amount }})</span>
                                </label>
                            @empty
                                <p class="text-gray-500">No hay categorías disponibles.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Brand Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <i data-feather="award" class="w-4 h-4 mr-2 text-orange-500"></i>
                            Marca
                        </h4>
                        <div class="space-y-2">
                            @forelse($loadVehiclesBrands as $vehicleBrand)
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                    <input type="checkbox"
                                        class="brand-filter rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                        value="{{ $vehicleBrand->brand }}">
                                    <span class="ml-3 text-gray-700">{{ $vehicleBrand->brand }}</span>
                                    <span class="ml-auto text-sm text-gray-500">({{ $vehicleBrand->amount }})</span>
                                </label>
                            @empty
                                <p class="text-gray-500">No hay marcas disponibles.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Rating Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <i data-feather="star" class="w-4 h-4 mr-2 text-yellow-500"></i>
                            Calificación
                        </h4>
                        <div class="space-y-2">
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="radio" name="rating"
                                    class="rating-filter text-blue-600 focus:ring-blue-500" value="4.5">
                                <div class="ml-3 flex items-center">
                                    <div class="flex text-yellow-400">
                                        <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                        <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                        <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                        <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                        <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                    </div>
                                    <span class="ml-2 text-gray-700">4.5+</span>
                                </div>
                            </label>
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="radio" name="rating"
                                    class="rating-filter text-blue-600 focus:ring-blue-500" value="4.0">
                                <div class="ml-3 flex items-center">
                                    <div class="flex text-yellow-400">
                                        <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                        <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                        <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                        <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                        <i data-feather="star" class="w-4 h-4 text-gray-300"></i>
                                    </div>
                                    <span class="ml-2 text-gray-700">4.0+</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vehicles Grid -->
            <div class="flex-1">
                <!-- Simplified results header -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6"
                    data-aos="fade-up">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-1">
                            <span id="resultsCount">33</span> vehículos disponibles
                        </h2>
                        <p class="text-gray-600">Encuentra el vehículo perfecto para ti</p>
                    </div>
                    <div class="flex items-center space-x-3 mt-4 md:mt-0">
                        <select id="sortBy"
                            class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="price-low">Precio: Menor a mayor</option>
                            <option value="price-high">Precio: Mayor a menor</option>
                            <option value="rating">Mejor calificación</option>
                            <option value="popular">Más popular</option>
                        </select>
                        <div class="flex items-center space-x-1">
                            <button onclick="toggleView('grid')" id="gridView"
                                class="p-2 rounded-lg bg-blue-600 text-white">
                                <i data-feather="grid" class="w-4 h-4"></i>
                            </button>
                            <button onclick="toggleView('list')" id="listView"
                                class="p-2 rounded-lg bg-gray-200 text-gray-600">
                                <i data-feather="list" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Vehicles Grid -->
                <div id="vehiclesGrid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <!-- Vehicle cards will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</section>
