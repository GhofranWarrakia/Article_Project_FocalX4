<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    // /**
    //  * Run the database seeds.
    //  */
    // public function run(): void
    // {   
    //     // User::truncate();
    //     DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    //     // Truncate the tables
    //     DB::table('articles')->truncate();
    //     DB::table('users')->truncate();

    //     // Enable foreign key checks
    //     DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    //     $user = User::create([
    //         'name'=>'Abrar',
    //         'email'=>'roro@gmail.com',
    //         'password'=>Hash::make('abrar1234'),
    //         'national_number' => '1234567890',
    //         'country' => 'YourCountry',
    //         'roles_name'=>['owner'],
    //         'status'=>'مفعل'
    //     ]);

    //     $role = Role::create(['name' => 'owner']);

    //     $permissions = Permission::pluck('id','id')->all();

    //     $role->syncPermissions($permissions);

    //     $user->assignRole([$role->id]);

        
    //     User::create([
    //         'name'=>'Ahmad',
    //         'email'=>'ahmad@gmail.com',
    //         'password'=>Hash::make('ahmad1234'),
    //         'national_number' => '0987654321',
    //         'country' => 'YourCountry',
    //         'roles_name'=>['Admin'],
    //         'status'=>'مفعل'
    //     ]);

    //     $role = Role::create(['name' => 'Admin']);

    //     $permissions = Permission::pluck('id','id')->all();

    //     $role->syncPermissions($permissions);

    //     $user->assignRole([$role->id]);
    // }

    // Disable foreign key checks
    public function run(): void
    { 
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    // Truncate the tables
    DB::table('articles')->truncate();
    DB::table('users')->truncate();

    // Enable foreign key checks
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    // Create the user
    $user1 = User::create([
        'name'=>'Abrar',
        'email'=>'roro@gmail.com',
        'password'=>Hash::make('abrar1234'),
        'national_number' => '1234567890',
        'country' => 'YourCountry',
        'roles_name'=>['owner'],
        'status'=>'مفعل'
    ]);

    // Check if the 'owner' role already exists
    $ownerRole = Role::firstOrCreate(['name' => 'owner']);

    // Sync permissions to the 'owner' role
    $permissions = Permission::pluck('id','id')->all();
    $ownerRole->syncPermissions($permissions);

    // Assign the 'owner' role to the user
    $user1->assignRole([$ownerRole->id]);

    // Create the second user
    $user2 = User::create([
        'name'=>'Ahmad',
        'email'=>'ahmad@gmail.com',
        'password'=>Hash::make('ahmad1234'),
        'national_number' => '0987654321',
        'country' => 'YourCountry',
        'roles_name'=>['Admin'],
        'status'=>'مفعل'
    ]);

    // Check if the 'Admin' role already exists
    $adminRole = Role::firstOrCreate(['name' => 'Admin']);

    // Sync permissions to the 'Admin' role
    $adminRole->syncPermissions($permissions);

    // Assign the 'Admin' role to the user
    $user2->assignRole([$adminRole->id]);
}
}
