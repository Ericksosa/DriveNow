<?php

namespace App\Livewire;

use App\Models\FuelType;
use Livewire\Component;
use Livewire\WithPagination;

class FuelTypeSearch extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
        if ($this->search == '') {
            return redirect()->route('fuel-type.index');
        }
    }
    public function render()
    {
        $fuelTypes = FuelType::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('livewire.fuel-type-search', [
            'fuelTypes' => $fuelTypes,
        ]);
    }
}
