<?php

namespace App\Http\Controllers;

use App\Http\Resources\BeritaCollection;
use App\Http\Resources\GaleriCollection;
use App\Http\Resources\JadwalCollection;
use App\Http\Resources\JadwalEkstraAnakCollection;
use App\Http\Resources\KalenderCollection;
use App\Http\Resources\NilaiAkhirCollection;
use App\Http\Resources\NilaiCollection;
use App\Http\Resources\OrtuCollection;
use App\Http\Resources\PembayaranOrtuCollection;
use App\Http\Resources\PresensiCollection;
use App\Http\Resources\TugasCollection;
use App\Http\Resources\UserNotifCollection;
use App\Models\Berita;
use App\Models\KalenderAkademik;
use App\Models\Murid;
use App\Models\Ortu as ModelsOrtu;
use App\Models\Ortu as orangtua;
use App\Models\Pembayaran;
use App\Models\PembayaranSiswa;
use App\Notifications\Undangan;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Ortu extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ort = Auth::guard('ortu')->user()->get();
        return $ort;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'no_telepon' => 'unique:users|max:255',
            'nama' => 'max:255',
            'email' => 'unique:users|max:255',
            'jenis_kelamin' => 'max:255',
            'kelurahan_id' => 'max:255',
            'alamat' => 'max:255',
            'tempat_lahir' => 'max:255',
            'tanggal_lahir' => 'max:255',
            'foto' => 'mimes:jpg,jpeg,png,gif|max:10000',
        ]);

        $ortu = Auth::guard('ortus')->user();
        $ortu->fill($request->except(['password', 'foto']));
        if ($request->password != null) {
            $ortu->password = Hash::make($request->password);
        }
        $ortu->save();
        $img = $request->file('foto');
        if ($img != null) {
            // Make a image name based on user name and current timestamp
            $name = $ortu->id . 'gambar_profil';
            // Define folder path
            $folder = '/sekolah/ortu/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $img->getClientOriginalExtension();
            // Upload image
            $ortu->foto = url('/') . 'storage' . $filePath;
            $ortu->save();
            $this->uploadOne($img, $folder, 'public', $name);
        }

        return new OrtuCollection(collect([$ortu]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function registrasi(Request $request)
    {
        $this->validate($request, [
            'no_telepon' => 'required|unique:users|max:255',
            'nama' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'jenis_kelamin' => 'required|max:255',
            'kelurahan_id' => 'required|max:255',
            'alamat' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'foto' => 'required|mimes:jpg,jpeg,png,gif|max:10000',
        ]);
        $ortu = new orangtua();
        $ortu->fill($request->except(['password', 'foto']));
        $ortu->password = Hash::make($request->password);
        $ortu->save();
        $img = $request->file('foto');
        if ($img != null) {
            // Make a image name based on user name and current timestamp
            $name = $ortu->id . 'gambar_profil';
            // Define folder path
            $folder = '/sekolah/ortu/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $img->getClientOriginalExtension();
            // Upload image
            $ortu->foto = url('/') . 'storage' . $filePath;
            $ortu->save();
            $this->uploadOne($img, $folder, 'public', $name);
        }

        return new OrtuCollection(collect([$ortu]));
    }
    public function listAnak()
    {
        //
        $anak = Murid::where('ortu_id', Auth::guard('ortus')->user()->id)->get();
        return ['data' => $anak, 'message' => 'berhasil', 'kode' => 200];
    }
    public function tambahAnak(Request $request)
    {
        // //
        $anak = Murid::find($request->anak_id);
        if ($anak->tanggal_lahir == $request->tanggal_lahir) {
            $anak->ortu_id = Auth::guard('ortus')->user()->id;
            $anak->save();
        } else {
            return [
                'kode' => '401',
                'message' => 'tanggal lahir salah',
            ];
        }
        return [
            'message' => 'berhasil',
            'kode' => 200,
            'data' => $anak,
        ];
    }
    public function hapusAnak($id)
    {
        //
        $anak = Murid::find($id);
        $anak->ortu_id = null;
        return ['message' => 'data telah dihapus', 'kode' => 200];
    }
    public function presensiAnak($id, Request $request)
    {
        $anak = Murid::find($id);
        return new PresensiCollection($anak->presensi()
                ->where('created_at', 'like', '%' . $request->tanggal . '%')->get());
    }
    public function nilaiAnak($id, Request $request)
    {
        $anak = Murid::find($id);
        return new NilaiCollection($anak->nilai()
                ->where(function ($query) use ($request) {
                    if ($request->tugas_id != null) {
                        $query->where('tugas_id', $request->tugas_id);
                    } else {
                        $query->wherenull('tugas_id');
                    }
                })
                ->where(function ($query) use ($request) {
                    if ($request->tahun_ajaran_id != null) {
                        $query->where('tahun_ajaran_id', $request->tahun_ajaran_id);
                    } else {
                        $query->wherenotnull('tahun_ajaran_id');
                    }
                })
                ->where(function ($query) use ($request) {
                    if ($request->mapel_id != null) {
                        $query->where('mapel_id', $request->mapel_id);
                    } else {
                        $query->wherenotnull('mapel_id');
                    }
                })
                ->where('created_at', 'like', '%' . $request->tanggal . '%')
                ->get());
    }
    public function nilaiAnakAkhir($id)
    {
        $anak = Murid::find($id);
        return new NilaiAkhirCollection($anak->nilai()
                ->select('mapel_id', DB::raw('avg(nilai) as nilai'))
                ->groupBy('mapel_id')->get());
        //return new NilaiAkhirCollection($anak->nilai->groupBy('mapel_id'));
    }

    public function tugasAnak($id)
    {
        $anak = Murid::find($id);
        return new TugasCollection($anak->rombel->tugas);
    }
    public function galeriAnak($id)
    {
        $anak = Murid::find($id);
        return new GaleriCollection($anak->rombel->galeri);
    }
    public function jadwalAnak($id)
    {
        $anak = Murid::find($id);
        return new JadwalCollection($anak->rombel->japel);
    }
    public function jadwalAnakEkstra($id)
    {
        $anak = Murid::find($id);
        return new JadwalEkstraAnakCollection($anak->ekstra);
    }
    public function berita(Request $request, $id)
    {
        $anak = Murid::find($id);
        return new BeritaCollection(
            $anak->rombel->sekolah->berita()->where(
                'judul',
                'like',
                '%' . $request->judul . '%'
            )->orderBy('id', 'desc')->paginate(5)->appends($request->query())
        );
    }

    public function buatNotif(Request $request)
    {
        $filePath = "";
        if ($request->gambar != null) {
            // Make a image name based on user name and current timestamp
            $name = rand() . rand();
            // Define folder path
            $folder = '/sekolah/undangan/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $request->gambar->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($request->gambar, $folder, 'public', $name);
        }
        $o = ModelsOrtu::first();
        $o->notify(new Undangan([
            'judul' => $request->judul,
            'pesan' => $request->pesan,
            'tempat' => $request->tempat,
            'rombel_id' => $request->rombel_id,
            'untuk' => $request->untuk,
            'gambar' => url('/') . '/storage' . $filePath,
            'jam_mulai' => $request->jam_mulai,
            'jam_akhir' => $request->jam_akhir,
            'tanggal' => $request->tanggal,
            'tipe' => $request->tipe,
            'link' => $request->link,
            'nama_pengirim' => Auth::guard('ortus')->user()->nama,
            'id_pengirim' => Auth::guard('ortus')->user()->id,
            'models_pengirim' => "App\Models\Ortu",
            'nama_penerima' => "",
            'id_penerima' => $request->id_penerima,
            'models_penerima' => $request->models_penerima,
            'rombel_id' => $request->rombel_id,
            'sekolah_id' => $request->sekolah_id,
        ]));
    }

    public function semua(Request $request)
    {
        $b = $request->tipe != null ? '"tipe":"' . $request->tipe . '"%' : '%';
        $anak = Murid::where('ortu_id', Auth::guard('ortus')->user()->id)->get();
        $pesan = DatabaseNotification::where('data', 'like', '%"models_penerima":%Ortu%')
            ->where('data', 'like', '%"tipe":"pesan"%')
            ->where('data', 'like', '%"id_penerima":"' . Auth::guard('ortus')->user()->id . '"%');
        foreach ($anak as $a) {
            $rombel = $a->rombel_id;
            $sekol = $a->rombel->sekolah_id;
            $notif = DatabaseNotification::
                where(function ($query) {
                $query->where('data', 'like', '%"untuk":"Ortu"%')
                    ->orwhere('data', 'like', '%"untuk":"Semua"%');
            })
                ->where(function ($query) use ($rombel, $sekol) {
                    $query->where('data', 'like', '%"rombel_id":"' . $rombel . '"%')
                        ->orwhere('data', 'like', '%"sekolah_id":' . $sekol . '%');
                })
                ->where('data', 'like', '%' . $b);
            $pesan->union($notif);
        }

        $final = $pesan->distinct('id')->paginate(5);
        return $final;
    }

    public function undang(Request $request, $id)
    {
        $anak = Murid::find($id);
        $rombel = $anak->rombel_id;
        $sekol = $anak->rombel->sekolah_id;
        $a = $request->tipe != null ? '"tipe":"' . $request->tipe . '"%' : '%';
        if ($request->tipe == "pesan") {
            return DatabaseNotification::where('data', 'like', '%"models_penerima":%Ortu%')
                ->where('id', 'like', '%' . $request->id . '%')
                ->where('data', 'like', '%"tipe":"pesan"%')
                ->where('data', 'like', '%"id_penerima":"' . Auth::guard('ortus')->user()->id . '"%')
                ->get();
        }
        return new UserNotifCollection(DatabaseNotification::where('data', 'like', '%' . $request->tipe . '%')
                ->where('id', 'like', '%' . $request->id . '%')
                ->where(function ($query) {
                    $query->where('data', 'like', '%"untuk":"Ortu"%')
                        ->orwhere('data', 'like', '%"untuk":"Semua"%');
                })
                ->where(function ($query) use ($rombel, $sekol) {
                    $query->where('data', 'like', '%"rombel_id":"' . $rombel . '"%')
                        ->orwhere('data', 'like', '%"sekolah_id":' . $sekol . '%');
                })
                ->where('data', 'like', '%' . $a)->paginate(5));
    }
    public function kalender(Request $request, $id)
    {
        $anak = Murid::find($id);
        return [
            'message' => 'sukses',
            'kode' => '200',
            'data' => new KalenderCollection(KalenderAkademik::where('tanggal_mulai', 'like', '%' .
                $request->tanggal_mulai . '%')
                    ->where('tanggal_selesai', 'like', '%' . $request->tanggal_selesai . '%')
                    ->where('sekolah_id', $anak->rombel->sekolah->id)
                // ->where('status', 0)
                    ->get()),
        ];
    }

    public function profil()
    {
        $ort = Auth::guard('ortus')->user();
        return new OrtuCollection(collect([$ort]));
    }

    public function pembayaran_old($id)
    {
        $anak = Murid::find($id);
        echo $anak->rombel->sekolah->id;
        $bayarsiswa = PembayaranSiswa::where('murid_id', $id)->get();
        $bayarnull = Pembayaran::select('pembayaran.*', DB::raw('null as pembayaran'))
            ->wherenull('rombel_id')->whereNotIn('id', $bayarsiswa)->where('sekolah_id', $anak->rombel->sekolah->id);
        $bayarombel = Pembayaran::
            select('pembayaran.*', DB::raw('null as pembayaran'))
            ->where('rombel_id', $anak->rombel_id)
            ->whereNotIn('id', $bayarsiswa)
            ->where('sekolah_id', $anak->rombel->sekolah->id);
        $bayaranak = Pembayaran::leftJoin('pembayaran_siswa', 'pembayaran_siswa.bayar_id', '=', 'pembayaran.id')
            ->where('pembayaran_siswa.murid_id', $id)
            ->select('pembayaran.*', 'pembayaran')
            ->union($bayarombel)->union($bayarnull)
            ->get();
        // dd($bayarnull);
        // die();
        return new PembayaranOrtuCollection(
            $bayaranak
        );
    }

    public function pembayaran($id)
    {
        $rombel = Murid::find($id)->rombel_id;
        $id_sekolah = Murid::find($id)->rombel->sekolah_id;

        $specificPaymentList = Pembayaran::where('rombel_id', $rombel)->get();
        foreach ($specificPaymentList as $specificPayment) {
            $specificPaymentId[$specificPayment->id] = $specificPayment->spesifik_dari;
        }

        $globalPaymentList = Pembayaran::where('sekolah_id', $id_sekolah)
            ->whereNull('rombel_id')
            ->get();
        $paymentId = array();
        foreach ($globalPaymentList as $globalPayment) {
            if (in_array($globalPayment->id, $specificPaymentId)) {
                array_push($paymentId, array_search($globalPayment->id, $specificPaymentId));
            } else {
                array_push($paymentId, $globalPayment->id);
            }
        }

        // pembayaran murid
        $data = Pembayaran::leftJoin('pembayaran_siswa', function ($join) use ($id) {
            $join->on('pembayaran.id', '=', 'pembayaran_siswa.bayar_id')
                ->where('pembayaran_siswa.murid_id', $id);
        })
            ->whereIn('pembayaran.id', $paymentId)
            ->select('pembayaran.id', 'pembayaran.nama', 'pembayaran.keterangan', 'pembayaran.biaya', 'pembayaran_siswa.pembayaran', 'pembayaran_siswa.created_at', 'pembayaran_siswa.updated_at')
            ->get();

        return new PembayaranOrtuCollection($data);
    }

    public function presensiTotal($id, Request $request)
    {
        $anak = Murid::find($id);
        return $anak->select('id', 'nisn', 'nama',
            DB::raw('(SELECT COUNT(*) FROM presensi WHERE murid_id = ' . $id . ' AND mapel_id = ' . $request->mapel_id . ') AS presensi_total , (SELECT COUNT(*)/(SELECT COUNT(*) AS total FROM presensi GROUP BY murid_id ORDER BY total DESC LIMIT 1) * 100 from presensi WHERE murid_id = ' . $id . ' AND mapel_id = ' . $request->mapel_id . ') as persentase_presensi'))->where('id', $id)->get();
    }
}