<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::where('email', 'test@gmail.com')->count() == 0) {
            $user = User::create([
                'name' => 'test',
                'email' => 'test@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
