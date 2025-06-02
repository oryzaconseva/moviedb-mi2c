<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat 10 user dummy
        User::factory(10)->create();

        // Buat 1 user khusus untuk login manual
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Ubah sesuai kebutuhan
        ]);

        // Jalankan seeder kategori
        $this->call(CategorySeeder::class);

        // Jangan buat movie dummy
        // \App\Models\Movie::factory(50)->create();
    }
}
