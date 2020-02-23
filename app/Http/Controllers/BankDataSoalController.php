<?php

namespace App\Http\Controllers;

use App\Http\Resources\SoalDataCollection;
use App\SoalDataModel;
use Illuminate\Http\Request;

class BankDataSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $false = 0;
        if (($request->has('soal_id') && $request->soal_id != '')) {
            $data = SoalDataModel::where('soal_id', $request->soal_id)
                ->paginate(1);

            if (count($data) > 0) {
                return new SoalDataCollection($data);

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
