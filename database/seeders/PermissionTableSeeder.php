<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Permission; 


use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

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

    ];
    
    
    
    foreach ($permissions as $permission) {
    
        Permission::updateOrCreate(
            ['name' => $permission, 'guard_name' => 'web'],
            ['updated_at' => now(), 'created_at' => now()]
    
        );
    }
}}