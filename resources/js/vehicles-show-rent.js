// Initialize AOS animations
AOS.init({
    duration: 800,
    easing: "ease-in-out",
    once: true,
    offset: 100,
});

// Initialize Feather icons (se volverá a llamar después de renderizar HTML dinámico)
feather.replace();

// Sample vehicle data
let vehicles = [];
let filteredVehicles = [];
let currentView = "grid";

// Si usas Blade, puedes definir isAuthenticated antes de este script desde el servidor:
// <script>const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};</script>
// Si no, el valor quedará en false por defecto (puedes cambiarlo con JS si lo necesitas).
if (typeof isAuthenticated === "undefined") {
    var isAuthenticated = false;
}

async function loadVehicles() {
    try {
        const response = await fetch("/client/load-vehicles"); // Realiza la solicitud a la ruta
        if (!response.ok) {
            throw new Error(
                `Error al cargar los vehículos: ${response.statusText}`
            );
        }
        vehicles = await response.json(); // Asigna los datos obtenidos a la variable `vehicles`

        // Inicializa filteredVehicles una vez cargados y renderiza
        filteredVehicles = [...vehicles];
        updateActiveFilters(); // si hay filtros por defecto
        renderVehicles();
    } catch (error) {
        console.error("Error al cargar los vehículos:", error);
    }
}

// Llama a la función para cargar los vehículos
loadVehicles();

// Initialize page
document.addEventListener("DOMContentLoaded", function () {
    setupEventListeners();

    // Inicializar valores visibles del slider (si existe)
    const priceRange = document.getElementById("priceRange");
    if (priceRange) {
        const v = priceRange.value || 200;
        const sel = document.getElementById("selectedPrice");
        const maxPrice = document.getElementById("maxPrice");
        if (sel) sel.textContent = v;
        if (maxPrice) maxPrice.textContent = "$" + v;
    }

    // Render inicial (en caso de que quieras mostrar algo antes de la carga ajax)
    renderVehicles();
});

function setupEventListeners() {
    // Price range slider
    const priceRange = document.getElementById("priceRange");
    if (priceRange) {
        priceRange.addEventListener("input", function () {
            const selectedPriceEl = document.getElementById("selectedPrice");
            const maxPriceEl = document.getElementById("maxPrice");
            if (selectedPriceEl) selectedPriceEl.textContent = this.value;
            if (maxPriceEl) maxPriceEl.textContent = "$" + this.value;
            applyFilters();
        });
    }

    // Filter checkboxes
    document
        .querySelectorAll(
            ".category-filter, .brand-filter, .feature-filter, .rating-filter"
        )
        .forEach((filter) => {
            filter.addEventListener("change", applyFilters);
        });

    // Sort dropdown
    const sortBy = document.getElementById("sortBy");
    if (sortBy) {
        sortBy.addEventListener("change", function () {
            sortVehicles(this.value);
            renderVehicles();
        });
    }

    // Quick search
    const quickSearch = document.getElementById("quickSearch");
    if (quickSearch) {
        quickSearch.addEventListener("input", function () {
            applyFilters();
        });
    }

    // Click handler para los "x" de los tags (delegación)
    document.addEventListener("click", function (e) {
        const icon = e.target.closest && e.target.closest(".filter-tag i");
        if (icon) {
            const tagSpan = icon.closest(".filter-tag");
            if (!tagSpan) return;
            // Obtener texto del tag (sin la "x")
            let tagText = tagSpan.childNodes[0]
                ? tagSpan.childNodes[0].textContent
                : tagSpan.textContent;
            tagText = (tagText || "").trim();

            // Intentar desmarcar la checkbox que tenga ese label (suponiendo estructura input + label)
            // Esto intenta coincidir el label que se usó en updateActiveFilters (cb.nextElementSibling.textContent)
            const allChecks = document.querySelectorAll(
                ".category-filter, .brand-filter, .feature-filter"
            );
            let removed = false;
            allChecks.forEach((cb) => {
                const lbl = cb.nextElementSibling;
                const lblTxt = lbl ? lbl.textContent.trim() : "";
                if (lblTxt === tagText) {
                    cb.checked = false;
                    removed = true;
                }
            });

            // Si no encontró por nombre, quizá fue el tag de precio: lo restablecemos
            if (!removed && tagText.startsWith("Hasta $")) {
                const priceRangeEl = document.getElementById("priceRange");
                if (priceRangeEl) {
                    priceRangeEl.value = 200;
                    const selectedPriceEl =
                        document.getElementById("selectedPrice");
                    const maxPriceEl = document.getElementById("maxPrice");
                    if (selectedPriceEl) selectedPriceEl.textContent = "200";
                    if (maxPriceEl) maxPriceEl.textContent = "$200";
                }
            }

            // Actualizar UI y aplicar filtros
            applyFilters();
        }
    });
}

function applyFilters() {
    const priceMax = parseInt(
        document.getElementById("priceRange")?.value || 200
    );
    const searchTerm =
        document.getElementById("quickSearch")?.value.toLowerCase() || "";

    const selectedCategories = Array.from(
        document.querySelectorAll(".category-filter:checked")
    ).map((cb) => cb.value);
    const selectedBrands = Array.from(
        document.querySelectorAll(".brand-filter:checked")
    ).map((cb) => cb.value);
    const selectedFeatures = Array.from(
        document.querySelectorAll(".feature-filter:checked")
    ).map((cb) => cb.value);
    const selectedRating = document.querySelector(
        ".rating-filter:checked"
    )?.value;

    filteredVehicles = vehicles.filter((vehicle) => {
        // Price filter
        if (vehicle.price > priceMax) return false;

        // Search filter
        if (
            searchTerm &&
            !vehicle.name.toLowerCase().includes(searchTerm) &&
            !vehicle.brand.toLowerCase().includes(searchTerm) &&
            !vehicle.category.toLowerCase().includes(searchTerm)
        ) {
            return false;
        }

        // Category filter
        if (
            selectedCategories.length > 0 &&
            !selectedCategories.includes(vehicle.category)
        )
            return false;

        // Brand filter
        if (
            selectedBrands.length > 0 &&
            !selectedBrands.includes(vehicle.brand)
        )
            return false;

        // Rating filter
        if (selectedRating && vehicle.rating < parseFloat(selectedRating))
            return false;

        return true;
    });

    updateActiveFilters();
    renderVehicles();
}

function updateActiveFilters() {
    const activeFiltersDiv = document.getElementById("activeFilters");
    const filterTagsDiv = document.getElementById("filterTags");

    if (!activeFiltersDiv || !filterTagsDiv) return;

    const tags = [];

    // Price tag
    const priceMax = parseInt(
        document.getElementById("priceRange")?.value || 200
    );
    if (priceMax < 200) {
        tags.push(`Hasta $${priceMax}/día`);
    }

    // Category tags
    document.querySelectorAll(".category-filter:checked").forEach((cb) => {
        tags.push(
            cb.nextElementSibling
                ? cb.nextElementSibling.textContent.trim()
                : cb.value
        );
    });

    // Brand tags
    document.querySelectorAll(".brand-filter:checked").forEach((cb) => {
        tags.push(
            cb.nextElementSibling
                ? cb.nextElementSibling.textContent.trim()
                : cb.value
        );
    });

    // Feature tags (opcional)
    document.querySelectorAll(".feature-filter:checked").forEach((cb) => {
        tags.push(
            cb.nextElementSibling
                ? cb.nextElementSibling.textContent.trim()
                : cb.value
        );
    });

    if (tags.length > 0) {
        activeFiltersDiv.classList.remove("hidden");
        filterTagsDiv.innerHTML = tags
            .map(
                (tag) =>
                    `<span class="filter-tag">${tag} <i data-feather="x" class="w-3 h-3 ml-1 cursor-pointer"></i></span>`
            )
            .join("");
        feather.replace();
    } else {
        activeFiltersDiv.classList.add("hidden");
        filterTagsDiv.innerHTML = "";
    }
}

function clearAllFilters() {
    const priceRangeEl = document.getElementById("priceRange");
    if (priceRangeEl) priceRangeEl.value = 25000;
    const selectedPrice = document.getElementById("selectedPrice");
    const maxPrice = document.getElementById("maxPrice");
    if (selectedPrice) selectedPrice.textContent = "25000";
    if (maxPrice) maxPrice.textContent = "$25000";

    const quickSearch = document.getElementById("quickSearch");
    if (quickSearch) quickSearch.value = "";

    document
        .querySelectorAll(
            ".category-filter, .brand-filter, .feature-filter, .rating-filter"
        )
        .forEach((cb) => {
            cb.checked = false;
        });

    filteredVehicles = [...vehicles];
    updateActiveFilters();
    renderVehicles();
}
window.clearAllFilters = clearAllFilters;

function sortVehicles(sortBy) {
    switch (sortBy) {
        case "price-low":
            filteredVehicles.sort((a, b) => a.price - b.price);
            break;
        case "price-high":
            filteredVehicles.sort((a, b) => b.price - a.price);
            break;
        case "rating":
            filteredVehicles.sort((a, b) => b.rating - a.rating);
            break;
        case "popular":
            filteredVehicles.sort((a, b) => b.popular - a.popular);
            break;
        case "newest":
            filteredVehicles.sort((a, b) => b.id - a.id);
            break;
    }
}

function renderVehicles() {
    const grid = document.getElementById("vehiclesGrid");
    const resultsCount = document.getElementById("resultsCount");

    if (!grid || !resultsCount) return;

    resultsCount.textContent = filteredVehicles.length;

    if (filteredVehicles.length === 0) {
        grid.innerHTML = `
            <div class="col-span-full text-center py-12">
                <i data-feather="search" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No se encontraron vehículos</h3>
                <p class="text-gray-600 mb-4">Intenta ajustar tus filtros</p>
                <button onclick="clearAllFilters()" class="btn-primary px-6 py-2 rounded-lg">
                    Limpiar filtros
                </button>
            </div>
        `;
        feather.replace();
        return;
    }

    // Generar tarjetas
    grid.innerHTML = filteredVehicles
        .map(
            (vehicle) => `
        <div class="vehicle-card overflow-hidden" data-aos="fade-up">
            <div class="relative">
                <img src="${vehicle.image}" alt="${
                vehicle.name
            }" class="w-full h-48 object-cover">
                <div class="absolute top-3 left-3 bg-gradient-to-r ${getCategoryColor(
                    vehicle.category
                )} text-white px-3 py-1 rounded-full text-sm font-medium">
                    ${getCategoryName(vehicle.category)}
                </div>
                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-gray-900 px-2 py-1 rounded-lg text-sm font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
</svg>
                    ${vehicle.rating ? vehicle.rating : "N/A"}
                </div>
                ${
                    vehicle.popular
                        ? '<div class="absolute top-10 right-3 bg-orange-500 text-white px-2 py-1 rounded-lg text-xs font-medium">Popular</div>'
                        : ""
                }
            </div>
            <div class="p-5">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">${
                    vehicle.name
                }</h3>

                <div class="grid grid-cols-2 gap-2 mb-4 text-sm text-gray-600">
                    ${vehicle.features
                        .slice(0, 4)
                        .map(
                            (feature, index) => `
                        <div class="flex items-center">
                            <i data-feather="${getFeatureIcon(
                                index
                            )}" class="w-4 h-4 mr-2 ${getFeatureColor(
                                index
                            )}"></i>
                            ${feature}
                        </div>
                    `
                        )
                        .join("")}
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-2xl font-bold text-blue-600">RD$${
                            vehicle.price
                        }</span>
                        <span class="text-gray-500">/día</span>
                    </div>
                    ${
                        isAuthenticated
                            ? `
                        <button onclick="openRentModal(${vehicle.id}, '${vehicle.name}')" class="btn-primary px-6 py-2 rounded-lg font-medium flex items-center">
                         <i data-feather="calendar" class="w-4 h-4 mr-1"></i>
                            Reservar
                        </button>
                    `
                            : `
                        <button onclick="openRentModal(${vehicle.id}, '${vehicle.name}')" class="btn-primary px-6 py-2 rounded-lg font-medium flex items-center">
                            <i data-feather="calendar" class="w-4 h-4 mr-1"></i>
                            Reservar
                        </button>
                    `
                    }

                </div>
            </div>
        </div>
    `
        )
        .join("");

    // Reemplazar iconos Feather y refrescar AOS después de DOM dinámico
    feather.replace();
    AOS.refresh();
}

function getCategoryColor(category) {
    const colors = {
        Económico: "from-green-500 to-green-600",
        SUV: "from-blue-600 to-blue-700",
        Lujo: "from-purple-600 to-purple-700",
        Deportivo: "from-red-500 to-red-600",
        Eléctrico: "from-green-400 to-blue-500",
    };
    return colors[category] || "from-gray-500 to-gray-600";
}

function getCategoryIcon(category) {
    const icons = {
        Económico: "dollar-sign",
        SUV: "truck",
        Lujo: "star",
        Deportivo: "zap",
        Eléctrico: "battery",
    };
    return icons[category] || "car";
}

function getCategoryName(category) {
    const names = {
        Económico: "Económico",
        SUV: "SUV",
        Lujo: "Lujo",
        Deportivo: "Deportivo",
        Eléctrico: "Eléctrico",
    };
    return names[category] || category;
}

function getFeatureIcon(index) {
    const icons = ["settings", "users", "zap", "tag"];
    return icons[index] || "check";
}

function getFeatureColor(index) {
    const colors = [
        "text-orange-500",
        "text-blue-600",
        "text-green-600",
        "text-purple-600",
    ];
    return colors[index] || "text-gray-500";
}

function toggleView(view) {
    currentView = view;
    const gridBtn = document.getElementById("gridView");
    const listBtn = document.getElementById("listView");
    const grid = document.getElementById("vehiclesGrid");

    if (view === "grid") {
        if (gridBtn) {
            gridBtn.classList.add("bg-blue-600", "text-white");
            gridBtn.classList.remove("bg-gray-200", "text-gray-600");
        }
        if (listBtn) {
            listBtn.classList.add("bg-gray-200", "text-gray-600");
            listBtn.classList.remove("bg-blue-600", "text-white");
        }
        if (grid)
            grid.className =
                "grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6";
    } else {
        if (listBtn) {
            listBtn.classList.add("bg-blue-600", "text-white");
            listBtn.classList.remove("bg-gray-200", "text-gray-600");
        }
        if (gridBtn) {
            gridBtn.classList.add("bg-gray-200", "text-gray-600");
            gridBtn.classList.remove("bg-blue-600", "text-white");
        }
        if (grid) grid.className = "grid grid-cols-1 gap-6";
    }
}

window.toggleView = toggleView;
function toggleMobileFilters() {
    const overlay = document.getElementById("filterOverlay");
    const panel = document.getElementById("mobileFilterPanel");

    if (overlay) overlay.classList.toggle("active");
    if (panel) panel.classList.toggle("active");
}
window.toggleMobileFilters = toggleMobileFilters;
function applyQuickSearch() {
    applyFilters();
}
window.applyQuickSearch = applyQuickSearch;
function applyMobileFilters() {
    applyFilters();
    toggleMobileFilters();
}

function openRentModal(vehicleId, vehicleName) {
    const modal = document.getElementById("rentModal");
    const vehicleIdInput = document.getElementById("selectedVehicleId");
    const vehicleNameInput = document.getElementById("selectedVehicleName");

    if (modal && vehicleIdInput && vehicleNameInput) {
        vehicleIdInput.value = vehicleId;
        vehicleNameInput.value = vehicleName;
        modal.classList.remove("hidden");
        modal.classList.add("flex");
        feather.replace();
    }
}

// Exponer la función al ámbito global
window.openRentModal = openRentModal;

function closeRentModal() {
    const modal = document.getElementById("rentModal");
    if (modal) {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    }

    // Reiniciar los campos del formulario
    const rentForm = document.getElementById("rentForm");
    if (rentForm) {
        rentForm.reset(); // Reinicia todos los campos del formulario
    }

    // Opcional: Reiniciar campos específicos si es necesario
    const vehicleIdInput = document.getElementById("selectedVehicleId");
    const vehicleNameInput = document.getElementById("selectedVehicleName");
    if (vehicleIdInput) vehicleIdInput.value = "";
    if (vehicleNameInput) vehicleNameInput.value = "";
}

// Exponer la función al ámbito global
window.closeRentModal = closeRentModal;

function openRatingModal(vehicleId, customerId, vehicleName) {
    const modal = document.getElementById("ratingModal");
    const vehicleIdInput = document.getElementById("vehicleId");
    const customerIdInput = document.getElementById("customerId");
    const vehicleNameSpan = document.getElementById("vehicleName");

    if (modal && vehicleIdInput && customerIdInput && vehicleNameSpan) {
        vehicleIdInput.value = vehicleId;
        customerIdInput.value = customerId;
        vehicleNameSpan.textContent = vehicleName;
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    }
}

function closeRatingModal() {
    const modal = document.getElementById("ratingModal");
    if (modal) {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    }
}

window.openRatingModal = openRatingModal;
window.closeRatingModal = closeRatingModal;
