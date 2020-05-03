<?php

use Illuminate\Database\Seeder;

class WeightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weights')->insert([
            [
                'user_id' => 1,
                'weight' => 96.5,
                'measure_dt' => date('2020-05-03 10:00:00')
            ],
            [
                'user_id' => 1,
                'weight' => 96.7,
                'measure_dt' => date('2020-05-04 11:00:00')
            ]
        ]);
    }
}
