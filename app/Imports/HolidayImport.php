<?php

namespace App\Imports;

use App\Models\HolidayDate;
use Maatwebsite\Excel\Concerns\ToModel;

class HolidayImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HolidayDate([
            //
        ]);
    }
}
