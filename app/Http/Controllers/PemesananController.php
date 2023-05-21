<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Http\Requests\StorePemesananRequest;
use App\Http\Requests\UpdatePemesananRequest;
use App\Models\DetailPemesanan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        // $data = Pemesanan::join('produk', 'pemesanan.id_produk', '=', 'produk.id_produk')
        //     ->join('pengguna', 'pemesanan.id_pengguna', '=', 'pengguna.id_pengguna')
        //     ->get();
        $datas = Pemesanan::with('detailPemesanan')->get();
        foreach ($datas as $data) {
        }
        // dd($datas[1]->detailPemesanan);
        return response()->json([
            "msg" => "berhasil ambil data",
            "data" => $datas
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePemesananRequest $request)
    {
        // Validator::make($request->all(), [
        //     'title' => 'required|unique:posts|max:255',
        //     'body' => 'required',
        // ])->validate();


        DB::beginTransaction();
        try {
            $dataPemesanan = Pemesanan::create([
                'id_pengguna' => $request->input('id_pengguna'),
                'total_harga' => $request->input('total_harga')
            ]);

            foreach ($request->input("list_produk") as $dataListProduk) {
                $isProdukExist = Produk::where("id_produk", $dataListProduk['id_produk'])->first();
                if($isProdukExist != null) {
                    DetailPemesanan::create([
                        'id_pemesanan' => $dataPemesanan->id,
                        'jumlah_pemesanan' => $dataListProduk['qty'],
                        'total_harga' => $isProdukExist->harga_produk,
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                "msg" => "data pemesanan berhasil diinputkan"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json([
                "msg" => "data gagal diinputkan",
                "error" => $th
            ]);
        }
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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
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
