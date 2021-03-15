<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'email' => 'nil1@gmail.com',
            'first_name' => 'nil',
            'last_name' => 'bari',
            'username' => 'userNil1',
            'password' => Hash::make('userNil1'),
            'status' => 'pending',
            'phone' => '+919975020044',
            'address' => 'keshav nagar',
            'locality' => 'locality',
            'city' => 'city',
            'zip' => 'zip',
            'state' => 'state',
            'profile_type' => 'profile_type',
            'profile_picture' => 'profile_picture',
            'designer_certificate' => '',
            'tag' => 'role:designer',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


    }
}
