<?php

namespace App\Livewire;

use App\Models\Inspection;
use Livewire\Component;
use Livewire\WithPagination;

class InspectionSearch extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
        if ($this->search == '') {
            return redirect()->route('inspection.index');
        }
    }
    public function render()
    {
        $inspections = Inspection::query()
            ->when($this->search, function ($query) {
                $query->whereHas('vehicle', function ($vehicleQuery) {
                        $vehicleQuery->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('livewire.inspection-search', [
            'inspections' => $inspections,
        ]);
    }
}
