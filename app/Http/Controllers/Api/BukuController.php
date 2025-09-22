<?php

namespace App\Http\Controllers\Api;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::orderBy('judul', 'asc')->get();
        return response()->json(
            [
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $buku
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $buku = new Buku;

        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'gagal input data',
                'data' => $validator->errors()
            ]);
        }


        $buku->judul = $request->judul;
        $buku->pengarang = $request->pengarang;
        $buku->tanggal_publikasi = $request->tanggal_publikasi;

        $post = $buku->save();

        return response()->json([
            'status' => true,
            'message' => 'sukses memasukan data'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::find($id);
        if ($buku) {
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $buku
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan',

            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::findOrFail($id);
        if (empty($buku)) {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan',
            ], 404);
        }

        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'gagal update data',
                'data' => $validator->errors()
            ]);
        }


        $buku->judul = $request->judul;
        $buku->pengarang = $request->pengarang;
        $buku->tanggal_publikasi = $request->tanggal_publikasi;

        $post = $buku->save();

        return response()->json([
            'status' => true,
            'message' => 'sukses update data'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        if (empty($buku)) {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan',
            ], 404);
        }

        $post = $buku->delete();

        return response()->json([
            'status' => true,
            'message' => 'sukses delete data'
        ]);
    }
}
