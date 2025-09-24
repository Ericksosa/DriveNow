<?php

namespace App\Livewire;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeSearch extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
        if ($this->search == '') {
            return redirect()->route('employee.index');
        }
    }

    public function render()
    {
        $employees = Employee::with('user') // relación con User (name, last_name)
            ->where(function ($query) {
                $query->where('id_card_number', 'like', '%' . $this->search . '%')
                    ->orWhere('commission_percentage', 'like', '%' . $this->search . '%')
                    ->orWhere('shift', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('last_name', 'like', '%' . $this->search . '%')
                          ->orWhere(DB::raw("CONCAT(name, ' ', last_name)"), 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        // Fallback: si no hay resultados pero se buscó algo, mostrar listado completo
        if ($employees->isEmpty() && $this->search != '') {
            $employees = Employee::with('user')
                ->orderBy('id', 'desc')
                ->paginate(15);
        }

        return view('livewire.employee-search', [
            'employees' => $employees,
        ]);
    }
}
