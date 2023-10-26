<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $master = Role::where('name', 'Master')->first();
        $local = Role::where('name', 'Local')->first();
        $perm = Role::where('name', 'Permissions')->first();

        Ability::create([
            'name' => 'access-all',
            'role_id' => $master->id
        ]);
        Ability::create([
            'name' => 'create-local',
            'role_id' => $local->id
        ]);
        Ability::create([
            'name' => 'access-permissions',
            'role_id' => $perm->id
        ]);
    }
}
