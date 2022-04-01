<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Barang',
            'data' => $barangs
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'keterangan' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $barang = Barang::create([
            'image' => $request->image,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
        ]);
        
        if ($barang) {
            return response()->json([
                'success' => true,
                'message' => 'Barang Created',
                'data' => $barang
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Barang Failed to save',
        ], 409);
    }
 
    public function show($id)
    {
        $barang = Barang::findOrfail($id);
        
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Barang',
            'data' => $barang
        ], 200);
    }

    public function update(Request $request, Barang $barang)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $barang = Barang::findOrFail($barang->id);

        if ($barang) {
            $barang->update([
                'image' => $request->image,
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Barang Update Success',
                'data' => $barang
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Barang Not Found',
        ], 404);
    }

    public function destroy($id)
    {
        $barang = Barang::findOrfail($id);

        if ($barang) {
            $barang->delete();
            return response()->json([
                'success' => true,
                'message' => 'Barang Deleted Success',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Barang Not Found',
        ], 404);
    }

}
