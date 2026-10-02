<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@tokoumkmpro.com',
            ],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin12345'),
            ]
        );

        $this->command->info('Akun admin berhasil dibuat.');
        $this->command->info('Email: admin@tokoumkmpro.com');
        $this->command->info('Password: admin12345');
    }
}
