<?php

namespace Database\Seeders;

use App\Models\Profil;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminExists = User::whereHas('role', fn ($query) => $query->where('name', 'Admin'))->exists();
        if (!$adminExists) {
            $admin = User::create([
                'email' => 'admin@admin.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role_id' => Role::where('name', 'Admin')->first()->id,
            ]);
            Profil::create([
                'user_id' => $admin->id,
                'name' => 'ADMIN',
            ]);
        }
    }
}
