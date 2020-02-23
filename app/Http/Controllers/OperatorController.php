<?php

namespace App\Http\Controllers;

use App\Http\Resources\OperatorCollection;
use App\Models\OperatorModel;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('prefix') && strlen($request->prefix) >= 4) {
            $dataOperator = OperatorModel::where('prefix', 'like', '%' . substr($request->prefix, 0, 4))->get();
            if (count($dataOperator) > 0) {
                return new OperatorCollection(($dataOperator));
            } else {
                return [
                    'code' => 200,
                    'message' => 'Data prefix operator tidak ditemukan',
                    'data' => [],
                ];

            }
        }
        return new OperatorCollection(OperatorModel::paginate());
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