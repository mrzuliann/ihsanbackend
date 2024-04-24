<?php

namespace App\Exports;

use App\Models\ExportDate;
use App\Models\HolidayDate;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportHoliday implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HolidayDate::select('holiday_name','holiday_desc','holiday_date','holiday_day','holiday_type','holiday_status')->get();
    }
}
