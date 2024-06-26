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
                'الحسابات',
                'الخيارات',
                'برنامج الادارة',
            'مراجعة طلبات الترقية',
            'تقديم طلب ترقية',
            'الاعدادات',
            'الصلاحيات',
            'الحظر',
            'حذف مستخدم',
            'تعديل مستخدم',
            ],


            'Admin' => [
                'الحسابات',
                'الخيارات',
                'برنامج الادارة',
            'مراجعة طلبات الترقية',
            'تقديم طلب ترقية',
            'حذف مستخدم',
            'تعديل مستخدم',
            ],
            
            'user' => [
                'الحسابات',
                'الخيارات',
                'تقديم طلب ترقية',
                'الحظر'
            ],

            'Author' =>[
                'الحسابات',
                'الخيارات',
                'الحظر'
            ]
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
