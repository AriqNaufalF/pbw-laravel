<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'ariqn55@gmail.com',
            'username' => 'admin',
            'fullname' => 'Ariq N',
            'password' => Hash::make('admin'),
            'address' => 'Bandung',
            'phonenumber' => '9837434',
            'agama' => 'islam',
            'gender' => 1,
        ]);
    }
}
