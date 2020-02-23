<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Prefixs_OperatorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Axis
        DB::table('operator')->insert(array(
            [
                'logo' => 'axis.png',
                'prefix' => '0832',
                'name' => "AXIS",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'axis.png',
                'prefix' => '0833',
                'name' => "AXIS",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'axis.png',
                'prefix' => '0838',
                'name' => "AXIS",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'axis.png',
                'prefix' => '0831',
                'name' => "AXIS",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ));

        //Smartfren
        DB::table('operator')->insert(array(
            [
                'logo' => 'smartfren.png',
                'prefix' => '0889',
                'name' => "Smartfren",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'smartfren.png',
                'prefix' => '0881',
                'name' => "Smartfren",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'smartfren.png',
                'prefix' => '0882',
                'name' => "Smartfren",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'smartfren.png',
                'prefix' => '0883',
                'name' => "Smartfren",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'smartfren.png',
                'prefix' => '0886',
                'name' => "Smartfren",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'smartfren.png',
                'prefix' => '0887',
                'name' => "Smartfren",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'smartfren.png',
                'prefix' => '0888',
                'name' => "Smartfren",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'smartfren.png',
                'prefix' => '0884',
                'name' => "Smartfren",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'smartfren.png',
                'prefix' => '0885',
                'name' => "Smartfren",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ));

        //Indosat Ooredoo
        DB::table('operator')->insert(array(
            [
                'logo' => 'indosat.png',
                'prefix' => '0814',
                'name' => "Indosat M2 Broadband",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'indosat.png',
                'prefix' => '0815',
                'name' => "Matrix dan Mentari",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'indosat.png',
                'prefix' => '0816',
                'name' => "Matrix dan Mentari",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'indosat.png',
                'prefix' => '0855',
                'name' => "Matrix",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'indosat.png',
                'prefix' => '0856',
                'name' => "IM3 dari operator Indosat",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'indosat.png',
                'prefix' => '0857',
                'name' => "IM3",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'indosat.png',
                'prefix' => '0858',
                'name' => "Mentari",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ));

        //3 / TRI
        DB::table('operator')->insert(array(
            [
                'logo' => '3.png',
                'prefix' => '0898',
                'name' => "TRI/3",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => '3.png',
                'prefix' => '0899',
                'name' => "TRI/3",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => '3.png',
                'prefix' => '0895',
                'name' => "TRI/3",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => '3.png',
                'prefix' => '0896',
                'name' => "TRI/3",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => '3.png',
                'prefix' => '0897',
                'name' => "TRI/3",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ));

        //Telkomsel
        DB::table('operator')->insert(array(
            [
                'logo' => 'telkomsel.png',
                'prefix' => '0811',
                'name' => "Halo",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'telkomsel.png',
                'prefix' => '0812',
                'name' => "Halo",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'telkomsel.png',
                'prefix' => '0813',
                'name' => "Halo",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'telkomsel.png',
                'prefix' => '0821',
                'name' => "simPATI",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'telkomsel.png',
                'prefix' => '0822',
                'name' => "simPATI",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'telkomsel.png',
                'prefix' => '0823',
                'name' => "AS",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'telkomsel.png',
                'prefix' => '0852',
                'name' => "AS",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'telkomsel.png',
                'prefix' => '0853',
                'name' => "AS",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'telkomsel.png',
                'prefix' => '0851',
                'name' => "AS",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ));

        //XL Axiata
        DB::table('operator')->insert(array(
            [
                'logo' => 'xl.png',
                'prefix' => '0859',
                'name' => "XL",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'xl.png',
                'prefix' => '0877',
                'name' => "XL",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'xl.png',
                'prefix' => '0878',
                'name' => "XL",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'xl.png',
                'prefix' => '0817',
                'name' => "XL",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'xl.png',
                'prefix' => '0818',
                'name' => "XL",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'logo' => 'xl.png',
                'prefix' => '0819',
                'name' => "XL",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ));

    }
}
