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
            'username'     => 'required|email',
            'password'     => 'required|min:6',
            'role'   => 'required',
            'saldo'   => 'required',
        ]);
        $data = Pengguna::create([
            "nama_pengguna" => $request->nama_pengguna,
            "username" => $request->username,
            "password" => $request->password,
            "role" => $request->role,
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
            'role'   => 'required',
            'saldo'   => 'required',
        ]);
        $data = Pengguna::where('id_pengguna', $id)->update([
            "nama_pengguna" => $request->nama_pengguna,
            "role" => $request->role,
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
