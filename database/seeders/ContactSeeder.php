<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('contacts')->insert([[
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => 9999999999,
            'address' => Str::random(10),
            'nickname' => Str::random(10),
            'company' => Str::random(10),
            'status' => 1,
            'user_id'=>1,
        ],[
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => 9999999999,
            'address' => Str::random(10),
            'nickname' => Str::random(10),
            'company' => Str::random(10),
            'status' => 1,
            'user_id'=>1,
        ],[
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => 9999999999,
            'address' => Str::random(10),
            'nickname' => Str::random(10),
            'company' => Str::random(10),
            'status' => 1,
            'user_id'=>1,
        ],[
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => 9999999999,
            'address' => Str::random(10),
            'nickname' => Str::random(10),
            'company' => Str::random(10),
            'status' => 1,
            'user_id'=>1,
        ],[
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => 9999999999,
            'address' => Str::random(10),
            'nickname' => Str::random(10),
            'company' => Str::random(10),
            'status' => 1,
            'user_id'=>1,
        ],[
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => 9999999999,
            'address' => Str::random(10),
            'nickname' => Str::random(10),
            'company' => Str::random(10),
            'status' => 1,
            'user_id'=>1,
        ],[
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => 9999999999,
            'address' => Str::random(10),
            'nickname' => Str::random(10),
            'company' => Str::random(10),
            'status' => 1,
            'user_id'=>1,
        ],[
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => 9999999999,
            'address' => Str::random(10),
            'nickname' => Str::random(10),
            'company' => Str::random(10),
            'status' => 1,
            'user_id'=>1,
        ],[
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => 9999999999,
            'address' => Str::random(10),
            'nickname' => Str::random(10),
            'company' => Str::random(10),
            'status' => 1,
            'user_id'=>1,
        ],[
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => 9999999999,
            'address' => Str::random(10),
            'nickname' => Str::random(10),
            'company' => Str::random(10),
            'status' => 1,
            'user_id'=>1,
        ],[
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => 9999999999,
            'address' => Str::random(10),
            'nickname' => Str::random(10),
            'company' => Str::random(10),
            'status' => 1,
            'user_id'=>1,
        ],[
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => 9999999999,
            'address' => Str::random(10),
            'nickname' => Str::random(10),
            'company' => Str::random(10),
            'status' => 1,
            'user_id'=>1,
        ],[
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => 9999999999,
            'address' => Str::random(10),
            'nickname' => Str::random(10),
            'company' => Str::random(10),
            'status' => 1,
            'user_id'=>1,
        ]]);
    }
}
