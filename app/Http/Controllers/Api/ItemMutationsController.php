<?php

namespace App\Http\Controllers\Api;
use App\Models\ItemMutations;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\apiResource;

class ItemMutationsController extends Controller
{
    public function index()
    {
        $itemmutation = ItemMutations::all();
        return new apiResource(true, 'List Mutasi Barang', $itemmutation);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mutation_id' =>'required|exists:mutations,id',
            'item_id' =>'required|exists:items,id',
            'qty' =>'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $create = ItemMutations::create([
            'mutation_id' => $request->mutation_id,
            'item_id' => $request->item_id,
            'qty' => $request->qty,
        ]);
        
        return new apiResource(true, 'Mutasi Barang Ditambahkan!', $create);
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'mutation_id' =>'required|exists:mutations,id',
            'item_id' =>'required|exists:items,id',
            'qty' =>'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $itemmutation = ItemMutations::find($id);
        if (!$itemmutation) {
            return response()->json(['error' => 'Mutasi Barang tidak ditemukan'], 404);
        }

        $itemmutation->update([
            'mutation_id' => $request->mutation_id,
            'item_id' => $request->item_id,
            'qty' => $request->qty,
        ]);
        
        return new apiResource(true, ' Mutasi Barang Berhasil Diupdate!', $itemmutation);
    }
    public function destroy($id)
    {
        $itemmutation = ItemMutations::find($id);
        if (!$itemmutation) {
            return response()->json(['error' => 'Mutasi Barang tidak ditemukan'], 404);
        }
        $itemmutation->delete();
        return new apiResource(true, 'Mutasi Barang Berhasil Dihapus!', null);
    }

}
