<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
    
     $roles = [


        'owner' => [
            'برنامج الادارة ',
            ' طلبات الترقية ',
            'تقديم طلب ترقية',
            'الاعدادات',
            ],


            'Admin' => [
            'برنامج الادارة ',
            ' طلبات الترقية ',
            'تقديم طلب ترقية',
            ],
            
            'user' => ['تقديم طلب ترقية',
            ],
            // Add more roles and their respective permissions as needed
        ];

        foreach ($roles as $roleName => $permissions) {
            // Check if the role already exists before creating
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);

            foreach ($permissions as $permissionName) {
                // Check if the permission exists before assigning
                $permission = Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
                $role->givePermissionTo($permission);
            }
        }
    }
    }
