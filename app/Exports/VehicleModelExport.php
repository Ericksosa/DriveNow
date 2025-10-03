<?php

namespace App\Exports;

use App\Models\VehicleModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class VehicleModelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return VehicleModel::all();
    }
}
