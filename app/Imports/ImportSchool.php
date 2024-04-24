<?php

namespace App\Imports;

use App\Models\School;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSchool implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new School([
            'name' => $row[0],
            'latitude' => $row[1],
            'longitude' => $row[2],
            'radius' => $row[3],
         ]);
    }
}
