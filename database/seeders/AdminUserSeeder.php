<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Insert Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password123'), // Replace with your desired password
            'mobile' => '1234567890', // Optional
        ]);

        // Insert Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Replace with your desired password
            'mobile' => '0987654321', // Optional
        ]);

        $superAdmin->assignRole('Super Admin');
        $admin->assignRole('Admin');
    }
}
