<?php

namespace App\Http\Controllers\Api;
use App\Models\Roles;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\apiResource;

class RolesController extends Controller
{
    public function index()
    {
        $role = Roles::all();
        return new apiResource(true, 'List Role', $role);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' =>'required|exists:users,id',
            'role_name' =>'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $create = Roles::create([
            'user_id' => $request->user_id,
            'role_name' => $request->role_name,
        ]);
        
        return new apiResource(true, 'Role Ditambahkan!', $create);
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' =>'required|exists:users,id',
            'role_name' =>'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $role = Roles::find($id);
        if (!$role) {
            return response()->json(['error' => 'Role tidak ditemukan'], 404);
        }

        $role->update([
            'user_id' => $request->user_id,
            'role_name' => $request->role_name,
        ]);
        
        return new apiResource(true, ' Role Berhasil Diupdate!', $role);
    }
    public function destroy($id)
    {
        $role = Roles::find($id);
        if (!$role) {
            return response()->json(['error' => 'Role tidak ditemukan'], 404);
        }
        $role->delete();
        return new apiResource(true, 'Role Berhasil Dihapus!', null);
    }

}
