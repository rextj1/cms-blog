<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user= User::where('email','tojufutughe@gmail.com')->first();

        if(!$user){
            User::create([
                'name'=> 'Rex',
                'email'=> 'tojufutughe@gmail.com',
                'role'=> 'admin',
                'password'=>Hash::make('destiny12')
            ]);
        }
    }
}
