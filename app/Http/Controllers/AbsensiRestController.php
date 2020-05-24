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

        $matkul=AbsensiRest::where('kode_matkul','=',$kode_matkul)
        ->where('nim', '=', $nim)
        ->whereDate('tanggal_absen', '=', $date)
        ->get();

        return response()->json($matkul, 200);

    }

    public function store($request)
    {
        $guide = AbsensiRest::create([
        	'nim' => $request['nim'],
        	'kode_matkul' => $request['kode_matkul'],
        	'kode_kelas' => $request['kode_kelas'],
        	'tanggal_absen' => $request['tanggal']
        ]);

        return response()->json($guide, 201);
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
