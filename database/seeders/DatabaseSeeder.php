<?php

namespace Database\Seeders;


use App\Models\User;


use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
     $adminRole = Role::firstOrCreate(['name' => 'admin']);

    // Create the user
    $admin = User::create([
        'name' => 'Super Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'), // use Hash::make() if you want
    ]);

    // Assign the role to the user
    $admin->assignRole($adminRole);
    
    }
}
