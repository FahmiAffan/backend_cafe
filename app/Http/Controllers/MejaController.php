<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Http\Requests\StoreMejaRequest;
use App\Http\Requests\UpdateMejaRequest;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Meja::all();
        return response()->json([
            "msg" => "berhasil",
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMejaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMejaRequest $request)
    {
        //
        $request->validate([
            'nomor_meja'     => 'required',
        ]);
        $data = Meja::create([
            "nomor_meja" => $request->nomor_meja,
        ]);
        return response()->json([
            "msg" => "Data Berhasil Diinputkan",
            "data" => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meja  $meja
     * @return \Illuminate\Http\Response
     */
    public function show(Meja $meja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meja  $meja
     * @return \Illuminate\Http\Response
     */
    public function edit(Meja $meja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMejaRequest  $request
     * @param  \App\Models\Meja  $meja
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMejaRequest $request, $id)
    {
        //
        $request->validate([
            'nomor_meja'     => 'required',
        ]);
        $data = Meja::where('id_meja',$id)->update([
            "nomor_meja" => $request->nomor_meja,
        ]);
        return response()->json([
            "msg" => "Data Berhasil Diinputkan",
            "data" => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * 
     * @param  \App\Models\Meja  $meja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Meja::where('id_meja', $id)->delete();
        return response()->json([
            "msg" => "Data Berhasil dihapus",
            "data" => $data,
            "id" => $id,
        ]);
    }
}
