<?php

use Illuminate\Database\Seeder;

class TemperaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('temperatures')->insert([
            [
                'user_id' => 1,
                'temperature' => 36.8,
                'measure_dt' => date('2020-05-03 10:00:00')
            ],
            [
                'user_id' => 1,
                'temperature' => 36.7,
                'measure_dt' => date('2020-05-04 11:00:00')
            ]
        ]);
    }
}
