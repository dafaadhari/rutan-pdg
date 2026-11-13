<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Satu-satunya akun pengelola portal: Humas.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@rutanpandeglang.go.id'],
            [
                'name' => 'Humas',
                'password' => Hash::make('password'),
            ]
        );
    }
}
