<?php

namespace App\Exports;

use App\Models\VehicleType;
use Maatwebsite\Excel\Concerns\FromCollection;

class VehicleTypeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return VehicleType::all();
    }
}
