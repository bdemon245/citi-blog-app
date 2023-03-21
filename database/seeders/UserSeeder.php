<?php

namespace Database\Seeders;

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
        $superAdmin = User::factory()->create([
            'name' => 'Mojahidul Islam',
            'email' => 'admin@gmail.com',
        ]);
        $superAdmin->assignRole('super admin');
        $users = User::factory(5)->create();
        foreach ($users as $user) {
            $user->assignRole('user');
        }
    }
}
