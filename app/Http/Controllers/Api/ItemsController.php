<?php

namespace App\Http\Controllers\Api;
use App\Models\items;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\apiResource;

class ItemsController extends Controller
{
    public function index()
    {
        $item = items::all();
        return new apiResource(true, 'List Barang', $item);
    }
        public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' =>'required|string',
            'item_code' =>'required|string',
            'category_id' =>'required|exists:categories,id',
            'location_id' =>'required|exists:locations,id',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $create = items::create([
            'item_name' => $request->item_name,
            'item_code' => $request->item_code,
            'category_id' => $request->category_id,
            'location_id' => $request->location_id,
        ]);
        
        return new apiResource(true, 'Barang Ditambahkan!', $create);
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'item_name' =>'required|string',
            'item_code' =>'required|string',
            'category_id' =>'required|exists:categories,id',
            'location_id' =>'required|exists:locations,id',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $item = items::find($id);
        if (!$item) {
            return response()->json(['error' => 'Barang tidak ditemukan'], 404);
        }

        $item->update([
            'item_name' => $request->item_name,
            'item_code' => $request->item_code,
            'category_id' => $request->category_id,
            'location_id' => $request->location_id,
        ]);
        
        return new apiResource(true, ' Barang Berhasil Diupdate!', $item);
    }
    public function destroy($id)
    {
        $item = items::find($id);
        if (!$item) {
            return response()->json(['error' => 'Barang tidak ditemukan'], 404);
    }

    $item->delete();

    return new apiResource(true, 'Barang Berhasil Dihapus!', null);
}
}
