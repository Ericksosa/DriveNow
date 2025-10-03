<?php

namespace App\Exports;

use App\Models\ReturnsAndRents;
use Maatwebsite\Excel\Concerns\FromCollection;

class RentsAndReturnsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ReturnsAndRents::all();
    }
}
