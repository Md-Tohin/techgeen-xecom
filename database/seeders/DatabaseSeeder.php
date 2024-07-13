<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {      
        $this->call(UserSeeder::class);
        $this->call(RolePermissionSeeder::class);
        \App\Models\WebsiteSeoSetting::create([
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'google_analytics' => '',
            'created_at' => Carbon::now(),
        ]);
        \App\Models\WebsiteGeneralSetting::create([
            'name' => 'Techgeen',
            'email' => 'techgeen@gmail.com',
            'url' => 'http://xecom.test/',
            'phone' => '0181xxxxxxx',
            'address' => 'Mirpur-6, Mirpur, Dhaka, Bangladesh',
            'logo' => '',
            'favicon' => '',
            'created_at' => Carbon::now(),
        ]);
    }
}
