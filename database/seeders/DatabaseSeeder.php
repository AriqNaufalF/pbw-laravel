<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use \App\Models\Collection;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
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

        Collection::factory(5)->create();
    }
}
