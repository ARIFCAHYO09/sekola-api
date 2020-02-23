<?php

use App\BankSoalKategoriModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class bankSoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now('utc')->toDateTimeString();

        $data = array(
            array('icon' => '', 'nama' => 'Pelajaran Sekolah', 'created_at' => $now,
                'updated_at' => $now),
            array('icon' => '', 'nama' => 'UTS', 'created_at' => $now,
                'updated_at' => $now),
            array('icon' => '', 'nama' => 'UAS', 'created_at' => $now,
                'updated_at' => $now),
            array('icon' => '', 'nama' => 'UN', 'created_at' => $now,
                'updated_at' => $now),
            array('icon' => '', 'nama' => 'TRY OUT', 'created_at' => $now,
                'updated_at' => $now),
        );

        BankSoalKategoriModel::insert($data);
    }
}