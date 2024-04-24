<?php

namespace App\Exports;

use App\Models\School;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportSchool implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return School::all();
    // }

    public function collection()
    {
        return School::select('name','latitude','longitude','radius')->get();
    }
}
