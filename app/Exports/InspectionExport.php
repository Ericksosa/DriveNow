<?php

namespace App\Exports;

use App\Models\Inspection;
use Maatwebsite\Excel\Concerns\FromCollection;

class InspectionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return Inspection::all();
    }
}
