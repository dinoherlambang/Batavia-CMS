<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User Management
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Role Management
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            
            // Content Management - Posts
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
            'edit own posts',
            'delete own posts',
            
            // Content Management - Pages
            'view pages',
            'create pages',
            'edit pages',
            'delete pages',
            'publish pages',
            
            // Content Management - Categories
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
            
            // Content Management - Tags
            'view tags',
            'create tags',
            'edit tags',
            'delete tags',
            
            // Media Management
            'view media',
            'upload media',
            'edit media',
            'delete media',
            
            // SEO Management
            'view seo',
            'edit seo',
            
            // Settings Management
            'view settings',
            'edit settings',
            
            // Dashboard Access
            'access admin',
            'view dashboard',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Super Admin Role - All permissions
        $superAdmin = \Spatie\Permission\Models\Role::create(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(\Spatie\Permission\Models\Permission::all());

        // Admin Role - Most permissions except super admin stuff
        $admin = \Spatie\Permission\Models\Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'view users', 'create users', 'edit users',
            'view roles',
            'view posts', 'create posts', 'edit posts', 'delete posts', 'publish posts',
            'view pages', 'create pages', 'edit pages', 'delete pages', 'publish pages',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view tags', 'create tags', 'edit tags', 'delete tags',
            'view media', 'upload media', 'edit media', 'delete media',
            'view seo', 'edit seo',
            'view settings', 'edit settings',
            'access admin', 'view dashboard',
        ]);

        // Editor Role - Content management permissions
        $editor = \Spatie\Permission\Models\Role::create(['name' => 'editor']);
        $editor->givePermissionTo([
            'view posts', 'create posts', 'edit posts', 'delete posts', 'publish posts',
            'view pages', 'create pages', 'edit pages', 'delete pages', 'publish pages',
            'view categories', 'create categories', 'edit categories',
            'view tags', 'create tags', 'edit tags',
            'view media', 'upload media', 'edit media',
            'view seo', 'edit seo',
            'access admin', 'view dashboard',
        ]);

        // Author Role - Limited content permissions
        $author = \Spatie\Permission\Models\Role::create(['name' => 'author']);
        $author->givePermissionTo([
            'view posts', 'create posts', 'edit own posts', 'delete own posts',
            'view pages', 'create pages',
            'view categories', 'view tags',
            'view media', 'upload media',
            'access admin', 'view dashboard',
        ]);

        // Subscriber Role - Very limited permissions
        $subscriber = \Spatie\Permission\Models\Role::create(['name' => 'subscriber']);
        $subscriber->givePermissionTo([
            'view dashboard',
        ]);

        echo "Roles and permissions created successfully!\n";
        echo "Created roles: super-admin, admin, editor, author, subscriber\n";
        echo "Created " . count($permissions) . " permissions\n";
    }
}
