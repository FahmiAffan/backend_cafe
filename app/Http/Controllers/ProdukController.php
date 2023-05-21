<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Produk::all();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nama_produk'     => 'required',
            'harga_produk'   => 'required',
            'jumlah_produk'   => 'required',
        ]);
        $data = Produk::create([
            "nama_produk" => $request->nama_produk,
            "harga_produk" => $request->harga_produk,
            "jumlah_produk" => $request->jumlah_produk
        ]);
        return response()->json([
            "msg" => "Data Berhasil Diinputkan",
            "data" => $data
        ]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $this->validate($request, [
            'nama_produk'     => 'required',
            'harga_produk'   => 'required',
            'jumlah_produk'   => 'required',
        ]);
        $data = Produk::where('id_produk', $id)->update([
            "nama_produk" => $request->nama_produk,
            "harga_produk" => $request->harga_produk,
            "jumlah_produk" => $request->jumlah_produk,
        ]);
        return response()->json([
            "msg" => "Data Berhasil Di Update",
            "data" => $data
        ]);
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
        $data = Produk::where('id_produk', $id)->delete();
        return response()->json([
            "msg" => "Data Berhasil dihapus",
            "data" => $data,
            "id" => $id,
        ]);
    }
}
