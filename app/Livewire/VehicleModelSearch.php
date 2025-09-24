<?php

namespace App\Livewire;

use App\Models\VehicleModel;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleModelSearch extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
        if ($this->search == '') {
            return redirect()->route('vehicle-model.index');
        }
    }
    public function render()
    {
        $vehicleModels = VehicleModel::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('livewire.vehicle-model-search', [
            'vehicleModels' => $vehicleModels,
        ]);
    }
}
