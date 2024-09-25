<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MutationTypes;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\apiResource;

class MutationTypesController extends Controller
{
    public function index()
    {
        $MutationType = MutationTypes::all();
        return new apiResource(true, 'List Tipe Mutasi', $MutationType);
    }
     public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mutation_type_name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $create = MutationTypes::create([
            'mutation_type_name' => $request->mutation_type_name,

        ]);
        
        return new apiResource(true, 'Tipe Mutasi Ditambahkan!', $create);
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'mutation_type_name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $MutationType = MutationTypes::find($id);
        if (!$MutationType) {
            return response()->json(['error' => 'Tipe Mutasi ditemukan'], 404);
        }

        $MutationType->update([
            'mutation_type_name' => $request->mutation_type_name,
        ]);
        
        return new apiResource(true, ' Tipe Mutasi Berhasil Diupdate!', $MutationType);
    }
    public function destroy($id)
    {
        $MutationType = MutationTypes::find($id);
        if (!$MutationType) {
            return response()->json(['error' => 'Tipe Mutasitidak ditemukan'], 404);
    }

    $MutationType->delete();

    return new apiResource(true, 'Tipe Mutasi Berhasil Dihapus!', null);
    }


}
