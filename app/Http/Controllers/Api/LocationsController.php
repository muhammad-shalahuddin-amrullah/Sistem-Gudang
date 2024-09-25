<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Locations;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\apiResource;

class LocationsController extends Controller
{
    public function index()
    {
        $location = Locations::all();
        return new apiResource(true, 'List Lokasi', $location);
    }
     public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location_name' => 'required|string|max:255',
            'location_address' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $create = Locations::create([
            'location_name' => $request->location_name,
            'location_address' => $request->location_address,
        ]);
        
        return new apiResource(true, 'Data Lokasi Ditambahkan!', $create);
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'location_name' => 'required|string|max:255',
            'location_address' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $location = Locations::find($id);
        if (!$location) {
            return response()->json(['error' => 'Lokasi tidak ditemukan'], 404);
        }

        $location->update([
            'location_name' => $request->location_name,
            'location_address' => $request->location_address,
        ]);
        
        return new apiResource(true, ' Lokasi Berhasil Diupdate!', $location);
    }
    public function destroy($id)
    {
        $location = Locations::find($id);
        if (!$location) {
            return response()->json(['error' => 'Lokasi tidak ditemukan'], 404);
    }

    $location->delete();

    return new apiResource(true, 'Lokasi Berhasil Dihapus!', null);
    }


}
