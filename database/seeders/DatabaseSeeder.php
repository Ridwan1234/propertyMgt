<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $admin = Role::create([
//            'name' => 'admin',
//            'display_name' => 'Administrator', // optional
//
//        ]);
//        $staff = Role::create([
//            'name' => 'staff',
//            'display_name' => 'Staff', // optional
//
//        ]);
//        $agent = Role::create([
//            'name' => 'agent',
//            'display_name' => 'Agent', // optional
//
//        ]);
//        $tenant = Role::create([
//            'name' => 'tenant',
//            'display_name' => 'Tenant', // optional
//
//        ]);
//        $landlord = Role::create([
//            'name' => 'landlord',
//            'display_name' => 'Landlord', // optional
//
//        ]);
//        $user = Role::create([
//            'name' => 'user',
//            'display_name' => 'User', // optional
//
//        ]);

        $this->call(LaratrustSeeder::class);
        $this->call(UsersSeeder::class);




    }
}
