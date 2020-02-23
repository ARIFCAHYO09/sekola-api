<?php

namespace App\Http\Controllers;

use App\BankSoalMapelModel;
use App\Http\Resources\MapelSoalCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankMapelSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $false = 0;
        if ($request->has('cat') && $request->cat != '') {
            $data = BankSoalMapelModel::where('kategori_id', $request->cat)
                ->paginate(10);

            if (count($data) > 0) {
                if (($request->has('cat') && $request->cat != '') && ($request->has('edu') && $request->edu != '')) {

                    $data2 = BankSoalMapelModel::leftJoin('bank_soal_kelas', 'bank_soal_kelas.mapel_id', '=', 'bank_soal_mapel.id')
                        ->where('bank_soal_mapel.kategori_id', $request->cat)
                        ->where('bank_soal_kelas.edukasi_id', $request->edu)
                        ->select(DB::RAW('DISTINCT(bank_soal_kelas.mapel_id) as id'),
                            'bank_soal_mapel.nama',
                            'bank_soal_mapel.icon',
                            'bank_soal_mapel.created_at',
                            'bank_soal_mapel.updated_at')
                        ->paginate(10);

                    if (count($data2) > 0) {
                        if (($request->has('cat') && $request->cat != '') && ($request->has('edu') && $request->edu != '') && ($request->has('class') && $request->class != '')) {
                            $data3 = BankSoalMapelModel::leftJoin('bank_soal_kelas', 'bank_soal_kelas.mapel_id', '=', 'bank_soal_mapel.id')
                                ->where('bank_soal_mapel.kategori_id', $request->cat)
                                ->where('bank_soal_kelas.edukasi_id', $request->edu)
                                ->where('bank_soal_kelas.kelas_id', $request->class)
                                ->select(DB::RAW('DISTINCT(bank_soal_kelas.mapel_id) as id'),
                                    'bank_soal_mapel.nama',
                                    'bank_soal_mapel.icon',
                                    'bank_soal_mapel.created_at',
                                    'bank_soal_mapel.updated_at')
                                ->paginate(10);
                            if (count($data3) > 0) {
                                return new MapelSoalCollection($data3);

                            } else {
                                $false = 1;
                            }
                        } else {
                            return new MapelSoalCollection($data2);
                        }
                    } else {
                        $false = 1;
                    }
                } else {
                    return new MapelSoalCollection($data);
                }
            } else {
                $false = 1;
            }

        } else {
            $false = 1;
        }

        if ($false > 0) {
            return response()->json([
                'code' => 200,
                'message' => 'Tidak ada data',
                'data' => [],
            ]);
        }

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