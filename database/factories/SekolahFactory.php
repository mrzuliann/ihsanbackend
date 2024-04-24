<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Sekolah;

class SekolahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    { 
            return [
                'radius' => 50,
                'sekolah_nama' => $this->faker->name(),
                'latitude' => $this->faker->latitude($min = -90, $max = 90),  
                'longitude' => $this->faker->longitude($min = -180, $max = 180),
               
            ]; 
    }
}
