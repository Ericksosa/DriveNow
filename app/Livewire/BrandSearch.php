<?php

namespace App\Livewire;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class BrandSearch extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
        if ($this->search == '') {
            return redirect()->route('brand.index');
        }
    }
    public function render()
    {
        $brands = Brand::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('livewire.brand-search', [
            'brands' => $brands,
        ]);
    }
}
