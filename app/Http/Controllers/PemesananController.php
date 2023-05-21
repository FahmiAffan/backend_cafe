<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Http\Requests\StorePemesananRequest;
use App\Http\Requests\UpdatePemesananRequest;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Pemesanan::join('produk', 'pemesanan.id_produk', '=', 'produk.id_produk')
            ->join('pengguna', 'pemesanan.id_pengguna', '=', 'pengguna.id_pengguna')
            ->get();
        return response()->json([
            "msg" => "berhasil ambil data",
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
     * @param  \App\Http\Requests\StorePemesananRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePemesananRequest $request)
    {
        //
        $this->validate($request, [
            'id_produk' => 'required',
            'id_pengguna' => 'required',
            'jumlah_pemesanan' => 'required',
            'total_harga' => 'required',
        ]);
        $data = Pemesanan::create([
            'id_produk' => $request->id_produk,
            'id_pengguna' => $request->id_pengguna,
            'jumlah_pemesanan' => $request->jumlah_pemesanan,
            'total_harga' => $request->total_harga,
        ]);
        return response()->json([
            "msg" => "data berhasil diinputkan",
            "data" => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemesanan  $Pemesanan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemesanan $Pemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemesanan  $Pemesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemesanan $Pemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePemesananRequest  $request
     * @param  \App\Models\Pemesanan  $Pemesanan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePemesananRequest $request, $id)
    {
        //
        $this->validate($request, [
            'id_produk' => 'required',
            'id_pengguna' => 'required',
            'jumlah_pemesanan' => 'required',
            'total_harga' => 'required',
        ]);
        $data = Pemesanan::where('id_pemesanan', $id)->update([
            'id_produk' => $request->id_produk,
            'id_pengguna' => $request->id_pengguna,
            'jumlah_pemesanan' => $request->jumlah_pemesanan,
            'total_harga' => $request->total_harga,
        ]);
        return response()->json([
            "msg" => "Data Berhasil Di Update",
            "data" => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemesanan  $Pemesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Pemesanan::where('id_pemesanan', $id)->delete();
        return response()->json([
            "msg" => "Data Berhasil dihapus",
            "data" => $data,
            "id" => $id,
        ]);
    }
}
