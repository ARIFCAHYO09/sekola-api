<?php

use Illuminate\Support\Facades\Route;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */
Route::post('/api/ortu/registrasi', 'Ortu@registrasi');
Route::get('/api/logout/ortu', 'AuthControllers@logoutOrtu');
Route::get('/api/logout/guru', 'AuthControllers@logoutGuru');

Route::group(['middleware' => ['cors', 'throttle']], function () {
    Route::post('/api/ortu/login', ['uses' => 'AuthControllers@loginOrtu', 'as' => 'ortu.login']);
    Route::post('/api/guru/login', 'AuthControllers@loginGuru');
    //Route::options('/api/guru/login', 'AuthControllers@loginGuru');
    Route::post('/api/guru/loginOTP', ['uses' => 'AuthControllers@loginGuruOTP', 'as' => 'guru.loginOTP']);
    Route::post('/api/ortu/loginOTP', ['uses' => 'AuthControllers@loginOrtuOTP', 'as' => 'ortu.loginOTP']);
    Route::get('/api/{guard}/login/{sosmed}', 'AuthControllers@redirectToProvider');
    Route::get('/api/login/{sosmed}/callback', 'AuthControllers@handleProviderCallback');
    Route::post('/api/{broker}/password', 'PasswordReset@email');
    Route::post('/api/password/reset', 'PasswordReset@res');
});

Route::group(['middleware' => [], 'prefix' => 'api'], function () {
    //baca notif
    Route::get('baca', 'Notif@baca');
    Route::get('unread', 'Notif@unread');
    //wilayah api
    Route::get('wilayah/provinsi', 'Wilayah@provinsi');
    Route::get('wilayah/kabupaten', 'Wilayah@kabupaten');
    Route::get('wilayah/kecamatan', 'Wilayah@kecamatan');
    Route::get('wilayah/kelurahan', 'Wilayah@kelurahan');
    //sekolah api
    Route::get('sekolah', 'Sekolah@index');
    Route::get('kelas', 'Rombel@indexOrtu');
    Route::get('rombel', 'Rombel@rombelOrtu');
    Route::get('murid', 'Rombel@muridOrtu');
    Route::get('wilayah/kelurahan/{id}/sekolah', 'Sekolah@indexKelurahan');

    //pulsa
    Route::get('pulsa/nominal', 'NominalController@index');
    Route::get('pulsa/operator', 'OperatorController@index');
    Route::get('remaining/point', 'RemPointController@index');
    Route::get('point/history', 'RemPointController@history');
    Route::post('pulsa/buy', 'RemPointController@store');

    //bank soal
    Route::get('bank/edukasi', 'BankEdukasiController@index');
    Route::get('bank/edukasi/kelas', 'BankEdukasiKelasController@index');
    Route::get('bank/cat/soal', 'BankCategorySoalController@index');
    Route::get('bank/mapel', 'BankMapelSoalController@index');
    Route::get('bank/soal', 'BankSoalController@index');
    Route::get('bank/soal/data', 'BankDataSoalController@index');
    Route::post('user/test/skor', 'UserTestSkorController@store');

    Route::group(['middleware' => ['auth:api', 'sekolah'], 'prefix' => 'guru'], function () {

        //mengajar
        Route::get('mengajar/mapel', 'Mapel@guru');
        Route::get('mengajar/rombel', 'Rombel@guru');
        //tahun ajaran
        Route::get('tapel', 'Tapel@index');
        //profil
        Route::get('profil', 'Guru@index');
        Route::put('profil', 'Guru@update');
        //get profil guru
        Route::get('get-profil', 'Guru@getprofile');
        //kategori
        Route::get('kategori', 'Galeri@kategori');
        //rombel
        Route::get('kelas', 'Rombel@index');
        Route::get('kelas/rombel/{kelas}', 'Rombel@rombel');
        Route::get('rombel/{id}', 'Rombel@murid');
        //ruang
        Route::get('ruang', 'Ruang@index');
        //ruang
        Route::get('mapel', 'Mapel@index');
        //presensi guru
        Route::get('presensi', 'Presensi@index');
        Route::post('presensi', 'Presensi@store');
        Route::put('presensi', 'Presensi@update');
        Route::delete('presensi/{id}', 'Presensi@destroy');
        //nilai guru
        Route::get('nilai', 'Nilai@index');
        Route::post('nilai', 'Nilai@store');
        Route::put('nilai', 'Nilai@update');
        Route::delete('nilai/{id}', 'Nilai@destroy');
        //tugas guru
        Route::get('tugas', 'Tugas@index');
        Route::post('tugas', 'Tugas@store');
        Route::put('tugas/{id}', 'Tugas@update');
        Route::delete('tugas/{id}', 'Tugas@destroy');
        //galeri guru
        Route::get('galeri', 'Galeri@index');
        Route::post('galeri', 'Galeri@store');
        Route::put('galeri/{id}', 'Galeri@update');
        Route::delete('galeri/{id}', 'Galeri@destroy');
        //japel guru
        Route::get('japel', 'Jadwal@japel');
        Route::get('jadwal/ekstra', 'Jadwal@JadwalEkstra');
        //voucher guru
        Route::get('voucher', 'Voucher@index');
        Route::post('voucher/redeem', 'Voucher@redeem');
        //undangan guru (notif)
        Route::post('undang', 'Notif@store');
        //kalender
        Route::get('kalender', 'KalenderAkademik@index');
        //pembayaran
        Route::get('pembayaran', 'Pembayaran@index');
        Route::get('pembayaran/rombel/{id}', 'Pembayaran@indexRombel');
        Route::get('pembayaran/rombel/{id}/murid', 'Pembayaran@indexRombelMurid');
        Route::post('pembayaran', 'Pembayaran@store');
        Route::put('pembayaran', 'Pembayaran@update');
        //notif
        Route::post('notif', 'Notif@store');
        Route::get('notif', 'Notif@notifikasiGuru');
        Route::get('notif/history', 'Notif@notifikasiPengirimanGuru');
        //transaksi
        Route::get('transaksi', 'Point@index');
        Route::get('voucher/history', 'Point@indexVoucher');
        //
    });

    Route::group(['middleware' => ['auth:ortus,', 'ortu'], 'prefix' => 'ortu'], function () {
        //buat pesan
        Route::post('buatpesan', 'Ortu@buatNotif');
        Route::group(['middleware' => ['anak']], function () {
            //presensi ortu
            Route::get('presensi/anak/{id}', 'Ortu@presensiAnak');
            //nilai ortu
            Route::get('nilai/anak/{id}', 'Ortu@nilaiAnak');
            Route::get('nilai/akhir/anak/{id}', 'Ortu@nilaiAnakAkhir');
            //tugas ortu
            Route::get('tugas/anak/{id}', 'Ortu@tugasAnak');
            //galeri ortu
            Route::get('galeri/anak/{id}', 'Ortu@galeriAnak');
            //japel ortu
            Route::get('jadwal/anak/{id}', 'Ortu@jadwalAnak');
            Route::get('jadwal_ekstra/anak/{id}', 'Ortu@jadwalAnakEkstra');
            //berita
            Route::get('berita/anak/{id}', 'Ortu@berita');
            //pembayaran
            Route::get('pembayaran/anak/{id}', 'Ortu@pembayaran');
            //kalender
            Route::get('kalender/anak/{id}', 'Ortu@kalender');
            //profil
            Route::get('presensitotal/anak/{id}', 'Ortu@presensiTotal');
            //undangan
            Route::get('undang/anak/{id}', 'Ortu@undang');
        });

        Route::get('undang', 'Ortu@semua');
        //update profil
        Route::put('profil', 'Ortu@update');
        Route::get('kategori', 'Galeri@kategori');
        //ortu anak
        Route::post('tambah_anak', 'Ortu@tambahAnak');
        Route::get('list_anak', 'Ortu@listAnak');
        Route::delete('hapus_anak/{id}', 'Ortu@hapusAnak');
        //profil
        Route::get('profil', 'Ortu@profil');
        // get metode pembayaran
        Route::get('list_metode_pembayaran', 'PembayaranApp@listPaymentMethod');
        // pembayaran app
        Route::post('pembayaran_app', 'PembayaranApp@pembayaran');
    });
});