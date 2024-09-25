<?php

namespace App\Http\Controllers\Api;
use App\Models\categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\apiResource;

class CategoriesController extends Controller
{
    public function index()
    {
        $Categories = Categories::all();
        return new apiResource(true, 'List Kategori', $Categories);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $create = Categories::create([
            'category_name' => $request->category_name,
        ]);
        
        return new apiResource(true, 'Kategori Ditambahkan!', $create);
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $Categories = Categories::find($id);
        if (!$Categories) {
            return response()->json(['error' => 'Kategori tidak ditemukan'], 404);
        }

        $Categories->update([
            'category_name' => $request->category_name,
        ]);
        
        return new apiResource(true, ' Kategori Berhasil Diupdate!', $Categories);
    }
    public function destroy($id)
    {
        $Categories = Categories::find($id);
        if (!$Categories) {
            return response()->json(['error' => 'Kategori tidak ditemukan'], 404);
    }

    $Categories->delete();

    return new apiResource(true, 'Kategori Berhasil Dihapus!', null);
}
    
}
