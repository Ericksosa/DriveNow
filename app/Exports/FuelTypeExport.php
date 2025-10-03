<?php

namespace App\Exports;

use App\Models\FuelType;
use Maatwebsite\Excel\Concerns\FromCollection;

class FuelTypeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FuelType::all();
    }
}
