<?php

namespace App\Http\Controllers;

use App\Http\Resources\GaleriCollection;
use App\Models\Galeri as ModelsGaleri;
use App\Models\KategoriGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadTrait;
use App\Models\PointAksi;
use App\Models\PointTransaksi;
use App\Models\User;

class Galeri extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new GaleriCollection(Auth::guard('api')->user()->galeri()
        ->where(function ($query) use ($request) {
            if ($request->rombel_id != null) {
                $query->where('rombel_id', $request->rombel_id);
            }
        })
        ->where(function ($query) use ($request) {
            if ($request->kategori_id != null) {
                $query->where('kategori_id', $request->kategori_id);
            }
        })
        ->where('keterangan', 'like', '%' . $request->keterangan . '%')
        ->where('created_at', 'like', '%' . $request->tanggal . '%')->latest()->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pointAksi = PointAksi::where('sekolah_id', Auth::guard('api')->user()->sekolah_id)
            ->where('nama', 'galeri')->first();
        if ($pointAksi != null) {
            $trk = new PointTransaksi();
            $trk->user_id = Auth::guard('api')->user()->id;
            $trk->point_aksi_id = $pointAksi->first()->id;
            $trk->status = 0;
            $trk->point = $pointAksi->first()->point;
            $trk->rombel_id = $request->rombel_id;
            $trk->save();
            $user = User::find(Auth::guard('api')->user()->id);
            $user->point += $trk->point;
            $user->save();
        }
        $arr = [];
        $img = [];
        $img = $request->file('gambar');
        for ($i = 0; $i < count($img); $i++) {
            if ($img[$i] != null) {
                // Make a image name based on user name and current timestamp
                $galeri = new ModelsGaleri();
                $galeri->rombel_id = $request->rombel_id;
                $galeri->kategori_id = $request->kategori_id;
                $galeri->keterangan = $request->keterangan[$i];
                $galeri->user_id = Auth::user()->id;
                $galeri->gambar = 'tes';
                $galeri->save();
                $name = $galeri->id . 'gambar_profil';
                // Define folder path
                $folder = '/sekolah/galeri/';
                // Make a file path where image will be stored [ folder path + file name + file extension]
                $filePath = $folder . $name . '.' . $img[$i]->getClientOriginalExtension();
                // Upload image
                $this->uploadOne($img[$i], $folder, 'public', $name);
                $galeri->gambar = url('/') . '/storage' . $filePath;
                $galeri->save();
            }
        }
        return ['message' => 'galeri berhasil diupload', 'kode' => 200];
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
    public function update(Request $request, $id)
    {
        $galeri = ModelsGaleri::find($id);
        $galeri->user_id = Auth::user()->id;
        $galeri->fill($request->except('gambar'));
        $galeri->save();
        $arr = [];
        $img = [];
        $img = $request->file('gambar');
        for ($i = 0; $i < count($img); $i++) {
            if ($img[$i] != null) {
                // Make a image name based on user name and current timestamp
                $name = $galeri->id . 'gambar_profil';
                // Define folder path
                $folder = '/sekolah/galeri/';
                // Make a file path where image will be stored [ folder path + file name + file extension]
                $filePath = $folder . $name . '.' . $img[$i]->getClientOriginalExtension();
                // Upload image
                $this->uploadOne($img[$i], $folder, 'public', $name);
                $arr[$i] = url('/') . '/storage' . $filePath;
            }
        }
        $galeri->gambar = json_encode($arr);
        return $galeri;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galeri = ModelsGaleri::find($id);
        $galeri->delete();
        return ['kode' => 200, 'message' => 'galeri berhasil dihapus'];
    }

    public function kategori()
    {
        return [
            'message' => 'sukses',
            'kode' => 200,
            'data' => KategoriGaleri::all()
        ];
    }
}
