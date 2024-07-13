<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email','admin@gmail.com')->first();
		Role::findOrCreate('superadmin', 'web');
        if(is_null($admin)){
            $user = new User();
            $user->name = 'Admin';
            $user->email = 'admin@gmail.com';
            $user->role = 'admin';
            $user->password = Hash::make('password');
            $user->assignRole('superadmin');
            $user->save();
        }
    }
}
