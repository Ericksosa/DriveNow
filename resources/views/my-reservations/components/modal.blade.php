@props(['vehicleId', 'customerId', 'vehicleName', 'rentId', 'hasRating'])

<div class="relative" id="rating-modal-{{ $vehicleId }}-{{ $rentId }}">
    <!-- Trigger Button -->
    <button type="button" onclick="openRatingModal{{ $vehicleId }}_{{ $rentId }}()"
    class="inline-flex items-center px-3 py-1.5 text-xs font-medium
    text-yellow-700 dark:text-yellow-300 bg-yellow-100 dark:bg-yellow-900
    rounded-lg hover:bg-yellow-200 dark:hover:bg-yellow-800
    focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-all
    disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed disabled:hover:bg-gray-300"
        @if ($hasRating) disabled title="Ya calificaste este vehículo, no puedes volver a calificarlo" @endif>
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
        </svg>
        Calificar
    </button>

    <!-- Modal Overlay -->
    <div id="modal-overlay-{{ $vehicleId }}-{{ $rentId }}"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-200"
        onclick="closeRatingModal{{ $vehicleId }}_{{ $rentId }}()">
        <!-- Modal Content -->
        <div id="modal-content-{{ $vehicleId }}-{{ $rentId }}" onclick="event.stopPropagation()"
            class="relative w-full max-w-lg bg-gray-900 rounded-2xl shadow-2xl border border-gray-900 overflow-hidden transform scale-95 transition-transform duration-200">
            <!-- Close Button -->
            <button type="button" onclick="closeRatingModal{{ $vehicleId }}_{{ $rentId }}()"
                class="absolute top-6 right-6 text-[#a0a0a0] hover:text-white transition-colors duration-200 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Modal Header -->
            <div class="px-8 pt-8 pb-6 text-center">
                <h2 class="text-3xl font-bold text-white mb-2 tracking-tight">
                    CALIFICA TU EXPERIENCIA
                </h2>
                <p class="text-[#a0a0a0] text-sm">
                    ¿Cómo fue tu experiencia con {{ $vehicleName }}?
                </p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('my-reservations.store-rating') }}" class="px-8 pb-8">
                @csrf
                <!-- Hidden Fields -->
                <input type="hidden" name="vehicle_id" value="{{ $vehicleId }}">
                <input type="hidden" name="customer_id" value="{{ $customerId }}">
                <input type="hidden" name="rent_id" value="{{ $rentId }}">
                <input type="hidden" name="rating" id="rating-input-{{ $vehicleId }}-{{ $rentId }}"
                    value="0">

                <!-- Star Rating -->
                <div class="mb-8">
                    <div class="flex justify-center gap-3 mb-2"
                        id="stars-container-{{ $vehicleId }}-{{ $rentId }}">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" data-star="{{ $i }}"
                                onclick="setRating{{ $vehicleId }}_{{ $rentId }}({{ $i }})"
                                onmouseenter="hoverRating{{ $vehicleId }}_{{ $rentId }}({{ $i }})"
                                onmouseleave="hoverRating{{ $vehicleId }}_{{ $rentId }}(0)"
                                class="transition-all duration-200 hover:scale-110 focus:outline-none focus:scale-110">
                                <svg class="w-12 h-12 transition-colors duration-200 text-[#2a2a2a]" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </button>
                        @endfor
                    </div>
                    <p class="text-center text-sm text-[#a0a0a0] hidden"
                        id="rating-text-{{ $vehicleId }}-{{ $rentId }}">
                        <span id="rating-value-{{ $vehicleId }}-{{ $rentId }}">0</span> de 5 estrellas
                    </p>
                </div>

                <!-- Comment Field -->
                <div class="mb-8">
                    <label for="comment-{{ $vehicleId }}-{{ $rentId }}"
                        class="block text-sm font-medium text-white mb-3">
                        Cuéntanos más (opcional)
                    </label>
                    <textarea id="comment-{{ $vehicleId }}-{{ $rentId }}" name="comment" rows="4"
                        placeholder="Comparte tu experiencia con este vehículo..."
                        class="w-full px-4 py-3 bg-gray-800 border border-[#2a2a2a] rounded-lg text-white placeholder-[#4a4a4a] focus:outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900 transition-colors duration-200 resize-none"></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3">
                    <button type="button" onclick="closeRatingModal{{ $vehicleId }}_{{ $rentId }}()"
                        class="flex-1 px-6 py-3 bg-[#2a2a2a] hover:bg-[#3a3a3a] text-white font-medium rounded-lg transition-colors duration-200">
                        Cancelar
                    </button>
                    <button type="submit" id="submit-btn-{{ $vehicleId }}-{{ $rentId }}"
                        class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-all duration-200 hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100"
                        disabled>
                        Enviar Calificación
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        let currentRating{{ $vehicleId }}_{{ $rentId }} = 0;
        let currentHover{{ $vehicleId }}_{{ $rentId }} = 0;

        window.openRatingModal{{ $vehicleId }}_{{ $rentId }} = function() {
            const overlay = document.getElementById('modal-overlay-{{ $vehicleId }}-{{ $rentId }}');
            const content = document.getElementById('modal-content-{{ $vehicleId }}-{{ $rentId }}');

            overlay.classList.remove('pointer-events-none', 'opacity-0');
            overlay.classList.add('opacity-100');

            setTimeout(() => {
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        };

        window.closeRatingModal{{ $vehicleId }}_{{ $rentId }} = function() {
            const overlay = document.getElementById('modal-overlay-{{ $vehicleId }}-{{ $rentId }}');
            const content = document.getElementById('modal-content-{{ $vehicleId }}-{{ $rentId }}');

            content.classList.remove('scale-100');
            content.classList.add('scale-95');

            setTimeout(() => {
                overlay.classList.remove('opacity-100');
                overlay.classList.add('opacity-0', 'pointer-events-none');
            }, 150);

            // Reset form
            currentRating{{ $vehicleId }}_{{ $rentId }} = 0;
            currentHover{{ $vehicleId }}_{{ $rentId }} = 0;
            updateStars{{ $vehicleId }}_{{ $rentId }}();
            document.getElementById('comment-{{ $vehicleId }}-{{ $rentId }}').value = '';
            document.getElementById('rating-text-{{ $vehicleId }}-{{ $rentId }}').classList.add(
                'hidden');
            document.getElementById('submit-btn-{{ $vehicleId }}-{{ $rentId }}').disabled = true;
        };

        window.setRating{{ $vehicleId }}_{{ $rentId }} = function(rating) {
            currentRating{{ $vehicleId }}_{{ $rentId }} = rating;
            document.getElementById('rating-input-{{ $vehicleId }}-{{ $rentId }}').value = rating;
            document.getElementById('rating-value-{{ $vehicleId }}-{{ $rentId }}').textContent =
                rating;
            document.getElementById('rating-text-{{ $vehicleId }}-{{ $rentId }}').classList.remove(
                'hidden');
            document.getElementById('submit-btn-{{ $vehicleId }}-{{ $rentId }}').disabled = false;
            updateStars{{ $vehicleId }}_{{ $rentId }}();
        };

        window.hoverRating{{ $vehicleId }}_{{ $rentId }} = function(rating) {
            currentHover{{ $vehicleId }}_{{ $rentId }} = rating;
            updateStars{{ $vehicleId }}_{{ $rentId }}();
        };

        function updateStars{{ $vehicleId }}_{{ $rentId }}() {
            const container = document.getElementById('stars-container-{{ $vehicleId }}-{{ $rentId }}');
            const stars = container.querySelectorAll('button');
            const activeRating = currentHover{{ $vehicleId }}_{{ $rentId }} ||
                currentRating{{ $vehicleId }}_{{ $rentId }};

            stars.forEach((star, index) => {
                const svg = star.querySelector('svg');
                if (index < activeRating) {
                    svg.classList.remove('text-[#2a2a2a]');
                    svg.classList.add('text-[#ff5722]');
                } else {
                    svg.classList.remove('text-[#ff5722]');
                    svg.classList.add('text-[#2a2a2a]');
                }
            });
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const overlay = document.getElementById(
                    'modal-overlay-{{ $vehicleId }}-{{ $rentId }}');
                if (!overlay.classList.contains('pointer-events-none')) {
                    closeRatingModal{{ $vehicleId }}_{{ $rentId }}();
                }
            }
        });
    })();
</script>
