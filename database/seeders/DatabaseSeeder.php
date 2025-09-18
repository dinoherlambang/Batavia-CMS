<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test categories
        DB::table('categories')->insert([
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Technology news and tutorials',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Business and entrepreneurship content',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Create test tags
        DB::table('tags')->insert([
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PHP',
                'slug' => 'php',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CMS',
                'slug' => 'cms',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Create test settings
        DB::table('settings')->insert([
            [
                'key' => 'site_name',
                'value' => 'Batavia CMS',
                'group' => 'general',
                'type' => 'string',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'site_description',
                'value' => 'A modern SEO-first content management system',
                'group' => 'general',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
