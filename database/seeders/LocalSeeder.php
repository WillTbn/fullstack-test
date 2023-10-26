<?php

namespace Database\Seeders;

use App\Models\Local;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userFirst = User::find(1);
        Local::create([
            'name' => 'first local',
            'zip_code' => '22710380',
            'street' => 'Rua Herculândia',
            'city' => 'Rio de Janeiro',
            'number' => 151,
            'user_id' => $userFirst->id,
        ]);
    }
}
