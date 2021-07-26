<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Database\Seeders\User;


//use App\User;
class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('users')->insert([
            'firstname'    => 'abcd',
			'lastname'     => 'efg',
            'email' => Str::random(10).'@gmail.com',
            'password'   =>  Hash::make('1234567'),
			'dob'=>'2021-07-05',
			'mobile'=>'7896547890',
			'gender'=>'female',
			'address'=>'agtyfty'
			'state'=>'Gujrat'
			'city'=>'Jamnagr',
            'remember_token' =>  Str::random(10),
			
        ]);
    }
}
