<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // public function run()
    // {
    //     \App\Models\User::factory(3500)->create();
    // }
    public function run()
    {
        // Gunakan factory untuk membuat 3500 pengguna
        \App\Models\User::factory(3500)->create();

        // Panggil seeder lain jika ada
        $this->call(UsersTableSeeder::class);
    }
}
