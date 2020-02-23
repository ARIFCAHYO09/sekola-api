<?php

use App\BankSoalMapelModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SoalMapelSeeder extends Seeder
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
            array('kategori_id' => 1, 'icon' => '', 'nama' => 'Bahasa Inggris', 'created_at' => $now,
                'updated_at' => $now),
            array('kategori_id' => 1, 'icon' => '', 'nama' => 'Matematika', 'created_at' => $now,
                'updated_at' => $now),
            array('kategori_id' => 1, 'icon' => '', 'nama' => 'Ilmu Pengetahuan Alam', 'created_at' => $now,
                'updated_at' => $now),
            array('kategori_id' => 1, 'icon' => '', 'nama' => 'Ilmu Pengetahuan Sosial', 'created_at' => $now,
                'updated_at' => $now),
            array('kategori_id' => 1, 'icon' => '', 'nama' => 'Bahasa Indonesia', 'created_at' => $now,
                'updated_at' => $now),
            array('kategori_id' => 1, 'icon' => '', 'nama' => 'Muatan Lokal', 'created_at' => $now,
                'updated_at' => $now),
        );

        BankSoalMapelModel::insert($data);

    }
}