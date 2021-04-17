<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name'	=> 'Adrian Satria',
            'email'	=> 'adriansatria058@gmail.com',
            'password'	=> bcrypt('secret'),
            'user_name' => 'AdrianS',
            'user_city' => 'Bandung',
            'user_kode_pos' => '40258',
            'user_registration_date' => null,
            'user_phone' => '085156462582',
            'user_address' => 'Jl. Ciganitri Tengah',
        ]);
    }
}
