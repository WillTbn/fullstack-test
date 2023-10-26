<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $master = Role::where('name', 'Master')->first();
        User::create([
            'name' => 'Jorge Nunes',
            'email' => env('INITIAL_USER_EMAIL', 'admin@gmail.com'),
            'password' => bcrypt(env('INITIAL_USER_PASSWORD', '12345678')),
            'role_id' => $master->id
        ]);
    }
}
