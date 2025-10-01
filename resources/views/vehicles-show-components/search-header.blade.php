<section class="search-header pt-44 pb-12 text-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-8" data-aos="fade-up">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">
                Encuentra tu vehículo perfecto
            </h1>
            <p class="text-lg text-white/90 max-w-xl mx-auto">
                Más de 50,000 vehículos disponibles para tu próximo viaje
            </p>
        </div>

        <!-- Simplified search bar with cleaner design -->
        <div class="max-w-3xl mx-auto bg-white rounded-xl p-4 shadow-lg" data-aos="fade-up" data-aos-delay="200">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <div class="md:col-span-2">
                    <div class="relative">
                        <i data-feather="search" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                        <input type="text" id="quickSearch" placeholder="Buscar vehículo..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-gray-900">
                    </div>
                </div>
                <div>
                    <select
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-gray-900">
                        <option>Todas las categorías</option>
                        @forelse($loadVehiclesCategories as $vehicleCategory)
                            <option value="{{ $vehicleCategory->category }}">{{ $vehicleCategory->category }}</option>
                        @empty
                            <option>No hay categorías</option>
                        @endforelse
                    </select>
                </div>
                <div>
                    <button onclick="applyQuickSearch()"
                        class="btn-primary w-full px-6 py-3 rounded-lg font-semibold flex items-center justify-center">
                        <i data-feather="search" class="w-5 h-5 mr-2"></i>
                        Buscar
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
