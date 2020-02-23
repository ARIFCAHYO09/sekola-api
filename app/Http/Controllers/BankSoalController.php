<?php

namespace App\Http\Controllers;

use App\Http\Resources\SoalCollection;
use App\SoalMapelModel;
use Illuminate\Http\Request;

class BankSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $false = 0;
        if (($request->has('mapel') && $request->mapel != '') && ($request->has('class') && $request->class != '')) {
            $data = SoalMapelModel::where('mapel_id', $request->mapel)
                ->where('kelas_id', $request->class)
                ->paginate(10);

            if (count($data) > 0) {
                return new SoalCollection($data);

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