<?php

namespace App\Livewire;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleSearch extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
        if ($this->search == '') {
            return redirect()->route('vehicle.index');
        }
    }
    public function render()
    {
        $vehicles = Vehicle::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
                $query->orWhere('chasis_number', 'like', '%' . $this->search . '%');
                $query->orWhere('engine_number', 'like', '%' . $this->search . '%');
                $query->orWhere('plate_number', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('livewire.vehicle-search', [
            'vehicles' => $vehicles,
        ]);
    }

}
