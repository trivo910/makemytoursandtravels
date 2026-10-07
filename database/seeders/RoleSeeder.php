<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name' => 'Administrator', 'slug' => 'admin', 'description' => 'Full administrative access.'],
            ['name' => 'Editor', 'slug' => 'editor', 'description' => 'Manage website content.'],
        ] as $role) {
            Role::query()->updateOrCreate(
                ['slug' => $role['slug']],
                ['name' => $role['name'], 'description' => $role['description']],
            );
        }
    }
}
