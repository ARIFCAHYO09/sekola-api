<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserNotif;
use App\Http\Resources\UserNotifCollection;
use App\Models\Ortu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Notifications\Undangan;
use App\Models\Rombel;
use App\Models\PointAksi;
use App\Models\PointTransaksi;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use App\Traits\UploadTrait;

class Notif extends Controller
{
    use UploadTrait;

    public function store(Request $request)
    {
        $pointAksi = PointAksi::where('sekolah_id', Auth::guard('api')->user()->sekolah_id)
            ->where('nama', 'undangan')->get();
        if ($pointAksi) {
            $trk = new PointTransaksi();
            $trk->user_id = Auth::guard('api')->user()->id;
            $trk->point_aksi_id = $pointAksi->first()->id;
            if ($request->rombel_id) {
                $trk->rombel_id = $request->rombel_id;
            }
            $trk->status = 0;
            $trk->point = $pointAksi->first()->point;
            $trk->save();
            $user = User::find(Auth::guard('api')->user()->id);
            $user->point += $trk->point;
            $user->save();
        }
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
        $o = Ortu::first();
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
                'nama_pengirim' => Auth::guard('api')->user()->nama,
                'id_pengirim' => Auth::guard('api')->user()->id,
                'models_pengirim' =>  "App\Models\User",
                'nama_penerima' => Auth::guard('api')->user()->nama,
                'id_penerima' => Auth::guard('api')->user()->id,
                'models_penerima' => "App\Models\User",
                'rombel_id' => $request->rombel_id,
                'sekolah_id' => Auth::guard('api')->user()->sekolah_id
                ]));
        return [ 'message' => 'sukses', 'kode' => 200];
    }
    public function notifikasiGuru(Request $request)
    {
        $a = $request->tipe != null ? '"tipe":"' . $request->tipe . '"%' : '%';
        if ($request->tipe == "pesan") {
            echo $request->tipe;
            return DatabaseNotification::
            where('data', 'like', '%"models_penerima":%User%')
            ->where('id', 'like', '%' . $request->id . '%')
            ->where('data', 'like', '%"tipe":"pesan"%')
            ->where('data', 'like', '%"id_penerima":"' . Auth::guard('api')->user()->id . '"%')
            ->get();
        }
        return new UserNotifCollection(DatabaseNotification::
            where('data', 'like', '%' . $request->tipe . '%')
            ->where('id', 'like', '%' . $request->id . '%')
            ->where(function ($query) {
                $query->where('data', 'like', '%"untuk":"guru"%')
                ->orwhere('data', 'like', '%"untuk":"semua"%');
            })
            ->where('data', 'like', '%"sekolah_id":' . Auth::guard('api')->user()->sekolah_id . '%')
            ->where('data', 'like', '%' . $a)->paginate(5));
    }
    public function notifikasiPengirimanGuru(Request $request)
    {
        $a = $request->tipe != null ? '"tipe":"' . $request->tipe . '"%' : '%';
        echo Auth::guard('api')->user()->id;
        return DatabaseNotification::where('id', 'like', '%' . $request->id . '%')->where('data', 'like', '%' . '"id_pengirim"' . ':' . Auth::guard('api')->user()->id . '%')
        ->where('data', 'like', '%"id_pengirim":' . Auth::guard('api')->user()->id . '%')
        ->where('data', 'like', '%' . $a)->paginate(5);
    }
    public function baca(Request $request)
    {
        $not = DatabaseNotification::where('id', $request->id)->first();
        $now = date_create('now')->format('Y-m-d H:i:s');
        $telo = $not->data;
        $usr = Auth::guard('api')->user()->id != null ? Auth::guard('api')->user()->id : Auth::guard('ortus')->user()->id;
        $mod = Auth::guard('api')->user()->id != null ? "App\Models\User" : "App\Models\Ortu";
        $i = 0;
        foreach ($telo["models_id"] as $t) {
            if ($t == $usr && $mod == $telo["models"][$i]) {
                return ["message" => "sudah dibaca", "code" => 200];
            }
            $i++;
        }
        array_push($telo["models"], $mod);
        array_push($telo["models_id"], $usr);
        array_push($telo["read_at"], $now);
        $not->data = $telo;
        $not->save();
        if ($not != null) {
            $not->save();
            return ["message" => "berhasil dibaca", "code" => 200];
        } else {
            return ["message" => "notifikasi tidak ditemukan", "code" => 200];
        }
    }
    public function unread(Request $request)
    {
        $not = DatabaseNotification::where('id', $request->id)->first();
        $usr = Auth::guard('api')->user()->id != null ? Auth::guard('api')->user()->id : Auth::guard('ortus')->user()->id;
        $mod = Auth::guard('api')->user()->id != null ? "App\Models\User" : "App\Models\Ortu";
        $telo = $not->data;
        //cari dulu id user
        $i = 0;
        //cek ono ora
        foreach ($telo["models_id"] as $t) {
            //pesan belum dibaca
            if ($t == $usr && $mod == $telo["models"][$i]) {
                echo $i;
                array_splice($telo["models"], $i);
                array_splice($telo["models_id"], $i);
                array_splice($telo["read_at"], $i);
                $not->data = $telo;
                $not->save();
                return ["message" => "pesan berhasil ditandai sebagai belum dibaca", "code" => 200];
            } else {
                //pesan sudah dibaca dan ingin ditandai sebagai belum dibaca
            }
            $i++;
        }
        return ["message" => "anda belum membaca", "code" => "200"];
    }
}
