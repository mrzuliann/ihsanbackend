<?php

namespace App\Exports;

// use App\Models\ExportPresensiHourday;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\PresensiHourDay;

class ExportPresensiHourday implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PresensiHourDay::select('ph_id','school_id','shift_id','ph_day','ph_time_start','ph_time_end')->get();
    }
}
