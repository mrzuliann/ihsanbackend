<?php

namespace App\Exports;

use App\Models\Shift;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportShift implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Shift::select('shift_id','School_id','shift_name')->get();
    }
}
