<?php

namespace App\Http\Controllers;

use App\ReviewSoalUserModel;
use App\SkorUserModel;
use App\SoalDataModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserTestSkorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = null;

        if ($request->jawaban) {
            $answer = array();
            $reviewAnswer = array();

            $answer['user_id'] = $request->user_id;
            $answer['soal_id'] = $request->soal_id;

            $reviewAnswer['user_id'] = $answer['user_id'];
            $reviewAnswer['soal_id'] = $answer['soal_id'];

            $dataSoal = SoalDataModel::leftJoin('bank_soal', 'bank_soal.id', '=', 'bank_soal_detail.soal_id')
                ->select('bank_soal_detail.*', 'bank_soal.jumlah_soal', 'bank_soal.skoring')
                ->where('soal_id', $request->soal_id)->get();

            $falsDuplikatSoal = 0;
            if (count($request->jawaban) == $dataSoal[0]->jumlah_soal) {
                $answer['jumlah_benar'] = 0;
                $answer['jumlah_salah'] = 0;

                foreach ($request->jawaban as $no_j => $r_j) {
                    if ($r_j['nomor_soal'] == $dataSoal[$no_j]->no_soal) {
                        if (strtolower($r_j['jawaban_soal']) == strtolower($dataSoal[$no_j]->jawaban)) {
                            $answer['jumlah_benar'] += 1;
                        } else {
                            $answer['jumlah_salah'] += 1;
                        }

                        $reviewAnswer['no_soal'] = $r_j['nomor_soal'];
                        $reviewAnswer['jawaban'] = strtolower($r_j['jawaban_soal']);

                        DB::transaction(function () use ($reviewAnswer) {

                            $dataReviewSkor = new ReviewSoalUserModel();
                            $dataReviewSkor->fill($reviewAnswer);
                            $dataReviewSkor->save();

                        });

                    } else {
                        $falsDuplikatSoal = 1;
                    }
                }

                if ($falsDuplikatSoal) {
                    $response['code'] = 500;
                    $response['message'] = 'Maaf Anda menjawab nomor soal yang sama berkali-kali!';

                } else {
                    $answer['skor'] = ($answer['jumlah_benar'] / $dataSoal[0]->jumlah_soal) * 100;

                    DB::transaction(function () use ($answer) {

                        $dataSkor = new SkorUserModel();
                        $dataSkor->fill($answer);
                        $dataSkor->save();

                    });

                    $response['code'] = 200;
                    $response['message'] = 'Anda berhasil mendapatkan skor!';
                }
            } else {
                $response['code'] = 500;
                $response['message'] = 'Maaf Anda baru menjawab ' . count($request->jawaban) . ' soal dari ' . $dataSoal[0]->jumlah_soal . ' soal';
            }
        } else {
            $response['code'] = 500;
            $response['message'] = 'Anda belum menjawab soal!';
        }

        return response()->json($response);
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
        //
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
}