<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class wilayah extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $sql = database_path('seeds/indonesia.sql');
        $user = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $db = env('DB_DATABASE');
        $q = sprintf("mysql -u %s -p%s %s < %s -A", $user, $password, $db, $sql);
        var_dump($q);
        exec($q);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
