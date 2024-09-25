<?php

namespace App\Http\Controllers\Api;
use App\Models\mutations;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\apiResource;

class MutationsController extends Controller
{
    public function index()
    {
        $mutation = mutations::all();
        return new apiResource(true, 'List Mutasi', $mutation);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' =>'required|date',
            'mutation_type_id' =>'required|exists:mutation_types,id',
            'user_id' =>'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $create = mutations::create([
            'date' => $request->date,
            'mutation_type_id' => $request->mutation_type_id,
            'user_id' => $request->user_id,
        ]);
        
        return new apiResource(true, 'Mutasi Ditambahkan!', $create);
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'date' =>'required|date',
            'mutation_type_id' =>'required|exists:mutation_types,id',
            'user_id' =>'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $mutation = mutations::find($id);
        if (!$mutation) {
            return response()->json(['error' => 'Mutasi tidak ditemukan'], 404);
        }

        $mutation->update([
            'date' => $request->date,
            'mutation_type_id' => $request->mutation_type_id,
            'user_id' => $request->user_id,
        ]);
        
        return new apiResource(true, ' Mutasi Berhasil Diupdate!', $mutation);
    }
    public function destroy($id)
    {
        $mutation = mutations::find($id);
        if (!$mutation) {
            return response()->json(['error' => 'Mutasi tidak ditemukan'], 404);
    }

    $mutation->delete();

    return new apiResource(true, 'Mutasi Berhasil Dihapus!', null);
    }
}
