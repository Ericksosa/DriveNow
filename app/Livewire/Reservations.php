<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\ReturnsAndRents;
use Livewire\Component;
use Livewire\WithPagination;

class Reservations extends Component
{
    use WithPagination;

    public $statusFilter = 'Todos'; // Filtro por defecto
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
        if ($this->search == '') {
            return redirect()->route('showReservations');
        }
    }

    public function render()
    {
        // Obtener el ID del cliente autenticado
        $customer = Customer::where('user_id', auth()->user()->id)->first();

        if (!$customer) {
            return view('livewire.reservations', ['reservations' => collect()]);
        }

        $customerId = $customer->id;

        // Obtener las reservas con el filtro de estado
        $query = ReturnsAndRents::with('vehicle', 'ratings')
            ->where('customer_id', $customerId)
            ->whereHas('vehicle', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });

        if ($this->statusFilter !== 'Todos') {
            $query->where('status', $this->statusFilter);
        }

        $reservations = $query->paginate(3);

        // Agregar la propiedad `hasRating` a cada reserva
        $reservations->getCollection()->each(function ($reservation) {
            $reservation->hasRating = $reservation->ratings && $reservation->ratings->rent_id === $reservation->id;
        });

        return view('livewire.reservations', compact('reservations'));
    }
}
