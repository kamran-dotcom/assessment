<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // run seed three time for data 
        $user = new User();

        $user->name ="Abdul Ahad";
        $user->email ="ahad@gmail.com";
        $user->password =Hash::make("ahad@12");

        $user->save();
    }
}
