<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Nominal extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Nominal
        DB::table('nominal')->insert(array(
            [
                'nominal' => '10000',
                'poin' => '12',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nominal' => '25000',
                'poin' => '26',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nominal' => '50000',
                'poin' => '50',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nominal' => '100000',
                'poin' => '100',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nominal' => '150000',
                'poin' => '150',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nominal' => '250000',
                'poin' => '190',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nominal' => '500000',
                'poin' => '450',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ));

    }
}