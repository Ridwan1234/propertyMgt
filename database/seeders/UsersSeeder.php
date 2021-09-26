<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user= User::create([
            'email'=>'admin@admin.com',
            'fname'=>'Administrator',
            'lname'=>'Admin',
            'password'=>Hash::make('password'),
        ]);

       $user->attachRole('admin');

        setting(['currency_name' => 'GBP']);
        setting(['currency_symbol' => '£']);
        setting(['invoice_generated_on' => 1]);
        setting(['invoice_due_in_days' => 7]);

        setting()->save();
    }


}
