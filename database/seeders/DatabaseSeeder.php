<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);

        Group::create([
            'name_en' => 'Managers',
            'name_ar' => 'المدراء',
        ]);

        Group::create([
            'name_en' => 'Peers',
            'name_ar' => 'الأقران',
        ]);

        Group::create([
            'name_en' => 'Subordinates',
            'name_ar' => 'المرؤوسين',
        ]);

        Group::create([
            'name_en' => 'Friends and Family',
            'name_ar' => 'الأصدقاء والعائلة',
        ]);
    }
}
