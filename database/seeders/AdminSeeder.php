<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        // User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the tables
        DB::table('articles')->truncate();
        DB::table('users')->truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::create([
            'name'=>'Abrar',
            'email'=>'roro@gmail.com',
            'password'=>Hash::make('abrar1234'),
            'national_number' => '1234567890',
            'country' => 'YourCountry',
        ]);
        
        User::create([
            'name'=>'Ahmad',
            'email'=>'ahmad@gmail.com',
            'password'=>Hash::make('ahmad1234'),
            'national_number' => '0987654321',
            'country' => 'YourCountry',
        ]);
    }
}
