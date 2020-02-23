<?php

use App\KelasEdukasiModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KelasEdukasiSeeder extends Seeder
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
            array('nama' => 'Kelas 1', 'created_at' => $now,
                'updated_at' => $now),
            array('nama' => 'Kelas 2', 'created_at' => $now,
                'updated_at' => $now),
            array('nama' => 'Kelas 3', 'created_at' => $now,
                'updated_at' => $now),
            array('nama' => 'Kelas 4', 'created_at' => $now,
                'updated_at' => $now),
            array('nama' => 'Kelas 5', 'created_at' => $now,
                'updated_at' => $now),
            array('nama' => 'Kelas 6', 'created_at' => $now,
                'updated_at' => $now),
            array('nama' => 'Kelas 7', 'created_at' => $now,
                'updated_at' => $now),
            array('nama' => 'Kelas 8', 'created_at' => $now,
                'updated_at' => $now),
            array('nama' => 'Kelas 9', 'created_at' => $now,
                'updated_at' => $now),
            array('nama' => 'Kelas 10', 'created_at' => $now,
                'updated_at' => $now),
            array('nama' => 'Kelas 11', 'created_at' => $now,
                'updated_at' => $now),
            array('nama' => 'Kelas 12', 'created_at' => $now,
                'updated_at' => $now),
        );

        KelasEdukasiModel::insert($data);

    }
}