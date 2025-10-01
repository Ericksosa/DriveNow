<?php

namespace App\Livewire;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ClientSearch extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
        if ($this->search == '') {
            return redirect()->route('client.index');
        }
    }

    public function render()
    {
        $clients = Customer::with('user') // relación con User (name, last_name)
            ->where(function ($query) {
                $query->where('id_card_number', 'like', '%' . $this->search . '%')
                    ->orWhere('driver_license_number', 'like', '%' . $this->search . '%')
                    ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('last_name', 'like', '%' . $this->search . '%')
                          ->orWhere(DB::raw("CONCAT(name, ' ', last_name)"), 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        // Fallback: si no hay resultados pero se buscó algo, mostrar listado completo
        if ($clients->isEmpty() && $this->search != '') {
            $clients = Customer::with('user')
                ->orderBy('id', 'desc')
                ->paginate(15);
        }

        return view('livewire.client-search', [
            'clients' => $clients,
        ]);
    }
}
