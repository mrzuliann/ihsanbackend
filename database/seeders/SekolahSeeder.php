<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sekolah; 

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Sekolah::factory(82)->create();
    }
}
