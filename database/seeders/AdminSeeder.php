<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::insert([
            [
                'name' => 'admin',
                'email' => 'admin@qrcode.test',
                'Password' => Hash::make('123456789')
            ]
        ]);
        User::insert([
            [
                'name' => 'user',
                'email' => 'user@qrcode.test',
                // 'Password' => Hash::make('123456789'),
                'phone' => "01060929469"
            ]
        ]);
        
    }
}
