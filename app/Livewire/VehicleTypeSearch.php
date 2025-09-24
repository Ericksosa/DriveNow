<?php

namespace App\Livewire;

use App\Models\VehicleType;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleTypeSearch extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
        if ($this->search == '') {
            return redirect()->route('vehicle-type.index');
        }
    }
    public function render()
    {
        $vehiclesTypes = VehicleType::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('livewire.vehicle-type-search', [
            'vehiclesTypes' => $vehiclesTypes,
        ]);
    }
}
