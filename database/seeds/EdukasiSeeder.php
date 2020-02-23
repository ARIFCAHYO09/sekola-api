<?php

use App\EdukasiModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EdukasiSeeder extends Seeder
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
            array('nama' => 'SD', 'created_at' => $now,
                'updated_at' => $now),
            array('nama' => 'SLTP', 'created_at' => $now,
                'updated_at' => $now),
            array('nama' => 'SMA', 'created_at' => $now,
                'updated_at' => $now),
        );

        EdukasiModel::insert($data);

    }
}
