<?php

namespace Database\Seeders;
use App\Models\Permission;


use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'برنامج الادارة ',
            ' طلبات الترقية ',
            'تقديم طلب ترقية',            
            'الاعدادات',
    ];
    
    
    
    foreach ($permissions as $permission) {
    
        Permission::create([
            'name' => $permission,
            'guard_name' => 'web'
    
        ]);
    }
    }
}



