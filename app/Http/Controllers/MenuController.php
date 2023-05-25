<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Menu::all();
        return response()->json(
            $data
        );
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
        $request->validate([
            'nama_menu'     => 'required',
            'harga_menu'   => 'required',
            'jenis'   => 'required',
            'deskripsi'   => 'required',
            'gambar'   => 'required',
        ]);

        $gambar = $request->file('gambar');
        $gambar->storeAs('public/blogs/', $gambar->hashName());

        $data = Menu::create([
            "nama_menu" => $request->nama_menu,
            "harga_menu" => $request->harga_menu,
            "jenis" => $request->jenis,
            "deskripsi" => $request->deskripsi,
            "gambar" => $gambar->hashName()
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
            'nama_menu'     => 'required',
            'harga_menu'   => 'required',
            'jumlah_menu'   => 'required',
        ]);
        $data = Menu::where('id_menu', $id)->update([
            "nama_menu" => $request->nama_menu,
            "harga_menu" => $request->harga_menu,
            "jumlah_menu" => $request->jumlah_menu,
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
        $data = Menu::where('id_menu', $id)->delete();
        return response()->json([
            "msg" => "Data Berhasil dihapus",
            "data" => $data,
            "id" => $id,
        ]);
    }
    public function getImage($id)
    {
        $menu = Menu::where('gambar' , $id)->get();
        $data = Storage::url("public/blogs/", $menu);
        return response()->download($data);
        // return response()->download('public/blogs/'+ $id);
    }
}
