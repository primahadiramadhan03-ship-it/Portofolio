<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'primhad03@gmail.com'],
            [
                'name' => 'PRIMA HADI RAMADHAN',
                'password' => Hash::make('password123'),
                'alamat' => 'Jakarta, Indonesia',
                'status' => 'Available for Work',
                'link_github' => 'https://github.com/prima',
            ]
        );
    }
}
