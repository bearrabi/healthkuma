<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
                'name' => 'kuma',
                'password' => Hash::make('kumasanno'),
            ],
            [
                'name' => 'usa',
                'password' => Hash::make('usasanno'),
            ]
        ]);
    }
}
