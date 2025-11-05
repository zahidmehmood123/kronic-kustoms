<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create super admin user
        User::updateOrCreate(
            ['email' => 'admin@kronickustoms.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'), // Change this password after first login
                'role' => 'super_admin',
                'email_verified_at' => now(),
            ]
        );

        // Create default settings
        Setting::setValue('product_price', 3500, 'number', 'Product base price');
        Setting::setValue('tax_rate', 8, 'number', 'Tax rate percentage');
        Setting::setValue('shipping_cost', 200, 'number', 'Shipping cost');
        Setting::setValue('deposit_percentage', 30, 'number', 'Deposit percentage for pre-orders');
    }
}
