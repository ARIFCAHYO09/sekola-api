<?php

namespace App\Http\Controllers;

use App\Http\Resources\BuyPulsaCollection;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\PulsaBuyModel as BuyPulsa;
use Illuminate\Http\Request;



class RemPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new UserCollection(User::where('id', $request->id)->get());
    }

    public function history(Request $request)
    {
        return new BuyPulsaCollection(BuyPulsa::where('user_id', $request->user_id)->orderBy('created_at', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nominal_id' => 'required',
            'operator_id' => 'required',
        ]);

        if (BuyPulsa::where('user_id', $request->user_id)->where('status', BuyPulsa::PROCCESS)->count() > 0) {
           
            return new BuyPulsaCollection(BuyPulsa::where('user_id', $request->user_id)
                ->where('status', BuyPulsa::PROCCESS)
                ->orderBy('created_at', 'DESC')->take(1)->get(), 
                    'Penukaran pulsa sebelumnya belum selesai'
                );
        }

        $buy = new BuyPulsa();
        $buy->fill($request->all());
        $saving = $buy->save();
        $newID = $buy->id;

        if ($saving) {
            return new BuyPulsaCollection(BuyPulsa::where('id', $newID)->get(), 
                    'Proses penukaran pulsa berhasil, silakan tunggu....'
                );
        }
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