<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AbsensiRest;

class AbsensiRestController extends Controller
{
    
	public function index()
    {
        return AbsensiRest::all();
    }

    public function show($kode_matkul, $nim, $date)
    {

        if (AbsensiRest::where('kode_matkul','=',$kode_matkul)->where('nim', '=', $nim)->whereDate('tanggal_absen', '=', $date)->exists()) {
            $absensi = AbsensiRest::where('kode_matkul','=',$kode_matkul)->where('nim', '=', $nim)->whereDate('tanggal_absen', '=', $date)->get()->toJson(JSON_PRETTY_PRINT);
            return response($absensi, 200);
        } else {
            return response()->json([
            "message" => "Absensi not found"
            ], 404);
         }
        
    }

    public function store(Request $request)
    {
        $absen = AbsensiRest::create($request->all());

        return response()->json($absen, 201);
    }

    public function update(Request $request, AbsensiRest $guide)
    {
        $guide->update($request->all());

        return response()->json($guide, 200);
    }

    public function delete(AbsensiRest $guide)
    {
        $guide->delete();

        return response()->json(null, 204);
    }

}
