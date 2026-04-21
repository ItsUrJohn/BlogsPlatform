<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'admin@blogplatform.com')->first();
        
        if (!$user) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@blogplatform.com',
                'password' => Hash::make('password123'),
                'profile_picture' => null,
            ]);
            $this->command->info('Admin user created!');
        }
    }
}