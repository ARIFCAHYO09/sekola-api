<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Hash;

class Guru extends Controller
{
    use UploadTrait;

    public function index()
    {
        $user = User::find(Auth::guard('api')->user()->id);
        return new UserCollection(collect([$user]));
    }
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
        $guru = Auth::guard('api')->user();
        $guru->fill($request->except(['password', 'foto']));
        if ($request->password != null) {
            $guru->password = Hash::make($request->password);
        }
        $guru->save();
        $img = $request->file('foto');
        if ($img != null) {
            // Make a image name based on user name and current timestamp
            $name = $guru->id . 'gambar_profil';
            // Define folder path
            $folder = '/sekolah/guru/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $img->getClientOriginalExtension();
            // Upload image
            $guru->foto = url('/') . '/storage' . $filePath;
            $guru->save();
            $this->uploadOne($img, $folder, 'public', $name);
        }

        return new UserCollection(collect([$guru]));
    }
    public function getprofile(Request $request)
    {
        if ($request->id != null) {
            $guru = User::where('id', $request->id);
        } else {
            $guru = User::where('sekolah_id', Auth::guard('api')->user()->sekolah_id);
        }
        return new UserCollection($guru->paginate(5));
    }
}
