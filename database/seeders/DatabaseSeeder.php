<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionAndGroupSeeder::class,
        ]);

        if (User::whereEmail(config('admin.seed.default_admin.email'))->doesntExist()) {
            $user = User::create([
                'first_name' => config('admin.seed.default_admin.first_name'),
                'last_name' => config('admin.seed.default_admin.last_name'),
                'email' =>  config('admin.seed.default_admin.email'),
                'password' => Hash::make(config('admin.seed.default_admin.password')),
                'email_verified_at' => now(),
                'is_active' => 1
            ]);

            $user->assignRole('Super Admin');
        }
    }
}
