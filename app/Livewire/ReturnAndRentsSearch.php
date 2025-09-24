<?php

namespace App\Livewire;

use App\Models\ReturnsAndRents;
use Livewire\Component;
use Livewire\WithPagination;

class ReturnAndRentsSearch extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
        if ($this->search == '') {
            return redirect()->route('return-and-rents.index');
        }
    }
    public function render()
    {
        $returnRents = ReturnsAndRents::query()
            ->when($this->search, function ($query) {
                $query->where('status', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('livewire.return-and-rents-search', [
            'returnRents' => $returnRents,
        ]);
    }
}
