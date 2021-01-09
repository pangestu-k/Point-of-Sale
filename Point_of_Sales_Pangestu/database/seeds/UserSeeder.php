<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'RizkyPangestu',
                'email' => 'Pangestu@gmail.com',
                'password' => Hash::make('123456789'),
                'level' => 'ADMIN'
            ],
            [
                'username' => 'fadil',
                'email' => 'fadil@gmail.com',
                'password' => Hash::make('123456789'),
                'level' => 'KASIR'
            ],
            [
                'username' => 'manyu',
                'email' => 'manyu@gmail.com',
                'password' => Hash::make('123456789'),
                'level' => 'MANAGER'
            ]
        ]);
    }
}
