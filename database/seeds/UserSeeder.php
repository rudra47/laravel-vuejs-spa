<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Rudra Sen',
            'email' => 'rudra@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
