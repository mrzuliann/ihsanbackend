<?php

namespace App\Imports;

use App\Models\PresensiHourDay;
use Maatwebsite\Excel\Concerns\ToModel;

class PresensiHourdayImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'nip' => $row[0],
            'name' => $row[1],
            // 'radius' => $row[4],
            "email" => $row[2],
            "school_id" => 34,
           "role_id" => 3, // User Type User
           'password' => bcrypt('password'),
        ]);
    }
}
