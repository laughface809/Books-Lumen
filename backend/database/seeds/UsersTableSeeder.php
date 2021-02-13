<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'identity_id' => '1337',
            'gender' => 1,
            'address' => 'DenpasarProgrammer',
            'photo' => 'denpasar.png', //images not found
            'email' => 'admin@admin.com',
            'password' => app('hash')->make('kudaliar'),
            'phone_number' => '0822982982',
            'api_token' => Str::random(40),
            'role' => 0,
            'status' => 1
        ]);
    }
}
