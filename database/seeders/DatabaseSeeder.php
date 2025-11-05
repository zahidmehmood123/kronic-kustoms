<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed admin user and settings
        $this->call(AdminSeeder::class);
        
        // Seed sample contact data
        $this->call(ContactSeeder::class);
        
        // Seed sample order data
        $this->call(OrderSeeder::class);
    }
}
