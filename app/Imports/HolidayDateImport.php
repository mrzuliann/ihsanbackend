<?php

namespace App\Imports;

use App\Models\HolidayDate;
use Maatwebsite\Excel\Concerns\ToModel;

class HolidayDateImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HolidayDate([
            // 'holiday_id' => $row[0],
            'holiday_name' => $row[0],
            'holiday_desc' => $row[1],
            'holiday_date' => $row[2],
            'holiday_day' => $row[3],
            'holiday_type' => $row[4],
            'holiday_status' => $row[5],
         ]);
    }
}
