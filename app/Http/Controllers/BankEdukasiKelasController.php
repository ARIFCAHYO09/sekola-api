<?php

namespace App\Http\Controllers;

use App\Http\Resources\EdukasiKelasCollection;
use App\KelasEdukasiModel;
use Illuminate\Http\Request;

class BankEdukasiKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $false = 0;
        if ($request->has('edu') && $request->edu != '') {
            $data = KelasEdukasiModel::where('edukasi_id', $request->edu)
                ->paginate(10);

            if (count($data) > 0) {
                return new EdukasiKelasCollection($data);
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
