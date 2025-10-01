<div id="mobileFilterPanel" class="mobile-filter-panel lg:hidden">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">Filtros</h3>
            <button onclick="toggleMobileFilters()" class="text-gray-600">
                <i data-feather="x" class="w-6 h-6"></i>
            </button>
        </div>
        <!-- Mobile filters content (same as desktop) -->
        <div class="space-y-6">
            <!-- Price Range -->
            <div>
                <h4 class="font-semibold text-gray-900 mb-4">Precio por día</h4>
                <input type="range" min="20" max="25000" value="25000" class="price-range-slider w-full">
                <div class="flex justify-between text-sm text-gray-600 mt-2">
                    <span>$20</span>
                    <span>$25000</span>
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
                        <input type="radio" name="rating" class="rating-filter text-blue-600 focus:ring-blue-500"
                            value="4.5">
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
                        <input type="radio" name="rating" class="rating-filter text-blue-600 focus:ring-blue-500"
                            value="4.0">
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
        <div class="mt-8 pt-6 border-t border-gray-200">
            <button onclick="applyMobileFilters()" class="w-full btn-primary py-3 rounded-lg font-semibold">
                Aplicar filtros
            </button>
        </div>
    </div>
</div>
