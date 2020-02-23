<?php

namespace App\Http\Controllers;

use App\Http\Resources\TugasCollection;
use Illuminate\Http\Request;
use App\Models\Tugas as ModelsTugas;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadTrait;

class Tugas extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new TugasCollection(ModelsTugas::
            // where(function ($query) use ($request) {
            //     if ($request->rombel_id != null) {
            //         $query->where('rombel_id', $request->rombel_id);
            //     } else {
            //         $query->wherenotnull('rombel_id');
            //     }
            // })
            // ->where(function ($query) use ($request) {
            //     if ($request->mapel_id != null) {
            //         $query->where('mapel_id', $request->mapel_id);
            //     } else {
            //         $query->wherenotnull('mapel_id');
            //     }
            // })
            where('user_id', Auth::guard('api')->user()->id)
            ->where('created_at', 'like', '%' . $request->tanggal . '%')
            ->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tugas = new ModelsTugas();
        $tugas->user_id = Auth::user()->id;
        $tugas->fill($request->all());
        $tugas->save();
        $img = $request->file('file');
        if ($img != null) {
            // Make a image name based on user name and current timestamp
            $name = $tugas->id . 'gambar_profil';
            // Define folder path
            $folder = '/sekolah/tugas/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $img->getClientOriginalExtension();
            // Upload image
            $tugas->file = url('/') . '/storage' . $filePath;
            $tugas->save();
            $this->uploadOne($img, $folder, 'public', $name);
        }
        return ['data' => $tugas, 'message' => 'tugas berhasil', 'kode' => 200];
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
        $tugas = ModelsTugas::find($id);
        $tugas->user_id = Auth::user()->id;
        $tugas->fill($request->all());
        $tugas->save();
        $img = $request->file('file');
        if ($img != null) {
            // Make a image name based on user name and current timestamp
            $name = $tugas->id . 'gambar_profil';
            // Define folder path
            $folder = '/sekolah/tugas/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $img->getClientOriginalExtension();
            // Upload image
            $tugas->file = url('/') . '/storage' . $filePath;
            $tugas->save();
            $this->uploadOne($img, $folder, 'public', $name);
        }
        return ['data' => $tugas, 'message' => 'tugas berhasil', 'kode' => 200];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presensi = ModelsTugas::find($id);
        $presensi->delete();
        return ['message' => 'presensi dihapus', 'kode' => 200];
    }
}
