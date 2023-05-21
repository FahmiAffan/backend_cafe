<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Http\Requests\StorePenggunaRequest;
use App\Http\Requests\UpdatePenggunaRequest;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Pengguna::all();
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
     * @param  \App\Http\Requests\StorePenggunaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenggunaRequest $request)
    {
        //
        $this->validate($request, [
            'nama_pengguna'     => 'required',
            'email'     => 'required|email',
            'password'     => 'required|min:6',
            'level'   => 'required',
            'saldo'   => 'required',
        ]);
        $data = Pengguna::create([
            "nama_pengguna" => $request->nama_pengguna,
            "email" => $request->email,
            "password" => $request->password,
            "level" => $request->level,
            "saldo" => $request->saldo,
        ]);
        return response()->json([
            "msg" => "Data Berhasil Diinputkan",
            "data" => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function show(Pengguna $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengguna $pengguna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenggunaRequest  $request
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenggunaRequest $request,$id)
    {
        //
        $this->validate($request, [
            'nama_pengguna'     => 'required',
            'level'   => 'required',
            'saldo'   => 'required',
        ]);
        $data = Pengguna::where('id_pengguna', $id)->update([
            "nama_pengguna" => $request->nama_pengguna,
            "level" => $request->level,
            "saldo" => $request->saldo,
        ]);
        return response()->json([
            "msg" => "Data Berhasil Di Update",
            "data" => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Pengguna::where('id_pengguna', $id)->delete();
        return response()->json([
            "msg" => "Data Berhasil dihapus",
            "data" => $data,
            "id" => $id,
        ]);
    }
}
