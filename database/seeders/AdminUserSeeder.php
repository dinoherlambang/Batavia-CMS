<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create admin user
        $adminUser = \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@batavia-cms.local',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        // Assign super-admin role
        $adminUser->assignRole('super-admin');

        // Create editor user
        $editorUser = \App\Models\User::create([
            'name' => 'Editor User',
            'email' => 'editor@batavia-cms.local',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        // Assign editor role
        $editorUser->assignRole('editor');

        // Create author user
        $authorUser = \App\Models\User::create([
            'name' => 'Author User',
            'email' => 'author@batavia-cms.local',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        // Assign author role
        $authorUser->assignRole('author');

        echo "Admin users created successfully!\n";
        echo "Admin: admin@batavia-cms.local / password\n";
        echo "Editor: editor@batavia-cms.local / password\n";
        echo "Author: author@batavia-cms.local / password\n";
    }
}
