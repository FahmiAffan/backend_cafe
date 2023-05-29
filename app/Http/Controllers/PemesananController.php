<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Http\Requests\StorePemesananRequest;
use App\Http\Requests\UpdatePemesananRequest;
use App\Models\DetailPemesanan;
use App\Models\Meja;
use App\Models\Menu;
use Error;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        // $data = Pemesanan::join('produk', 'pemesanan.id_menu', '=', 'produk.id_menu')
        //     ->join('pengguna', 'pemesanan.id_user', '=', 'pengguna.id_user')
        //     ->get();

        $datas = Pemesanan::with(['detailPemesanan', 'detailMeja', 'detailPemesanan.detailMenu'])->get();
        return response()->json($datas);
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
        // $request->validate([
        //     'id_users' => 'required',
        //     'id_meja' => 'required',
        //     'total_harga' => 'required',
        //     'id_pemesanan' => 'required',
        //     'jumlah_pemesanan' => 'required',
        //     'total_harga' => 'required'
        // ]);

        DB::beginTransaction();
        try {
            $dataPemesanan = Pemesanan::create([
                'id_users' => $request->input('id_users'),
                'id_meja' => $request->input('id_meja'),
                'total_harga' => $request->input('total_harga')
            ]);

            foreach ($request->input("list_menu") as $dataListProduk) {
                $isProdukExist = Menu::where("id_menu", $dataListProduk['id_menu'])->first();
                if ($isProdukExist != null) {
                    $data = DetailPemesanan::create([
                        'id_menu' => $dataListProduk['id_menu'],
                        'id_pemesanan' => $dataPemesanan->id_pemesanan,
                        'id_meja' => $dataPemesanan->id_meja,
                        'jumlah_pemesanan' => $dataListProduk['qty'],
                        'total_harga' => $isProdukExist->harga_menu,
                    ]);
                    Log::debug($data);
                } else {
                    throw new \Exception("Menu tidak ada");
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
        $data = DetailPemesanan::where('id_detail_pemesanan', $id)->update([
            'jumlah_pemesanan' => $request->jumlah_pemesanan,
        ]);
        return response()->json($data);
        // $this->validate($request, [
        //     'id_menu' => 'required',
        //     'id_users' => 'required',
        //     'jumlah_pemesanan' => 'required',
        //     'total_harga' => 'required',
        // ]);
        // $data = Pemesanan::where('id_pemesanan', $id)->update([
        //     'id_menu' => $request->id_menu,
        //     'id_users' => $request->id_users,
        //     'jumlah_pemesanan' => $request->jumlah_pemesanan,
        //     'total_harga' => $request->total_harga,
        // ]);
        // return response()->json([
        //     "msg" => "Data Berhasil Di Update",
        //     "data" => $data
        // ]);
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
        // $pemesanan->delete();
        DetailPemesanan::where('id_pemesanan' ,$id)->delete();
        Pemesanan::where('id_pemesanan' , $id)->delete();
    }
    public function UpdateQty(UpdatePemesananRequest $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'jumlah_pemesanan' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }
        $data = DetailPemesanan::where('id_detail_pemesanan', $id)->update([
            'jumlah_pemesanan' => $request->jumlah_pemesanan,
        ]);
        return response()->json($data);
    }
}
