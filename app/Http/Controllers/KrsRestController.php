<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\KrsRest;

class KrsRestController extends Controller
{
    
	public function index()
    {
        return KrsRest::all();
    }

    public function show($kode_matkul, $nim)
    {

        if (KrsRest::where('kode_matkul','=',$kode_matkul)->where('nim', '=', $nim)->exists()) {
            $krs = KrsRest::where('kode_matkul','=',$kode_matkul)->where('nim', '=', $nim)->get()->toJson(JSON_PRETTY_PRINT);
            return response($krs, 200);
        } else {
            return response()->json([
            "message" => "KRS not found"
            ], 404);
         }

    }

    public function store(Request $request)
    {
        $guide = KrsRest::create($request->all());

        return response()->json($guide, 201);
    }

    public function update(Request $request, KrsRest $guide)
    {
        $guide->update($request->all());

        return response()->json($guide, 200);
    }

    public function delete(KrsRest $guide)
    {
        $guide->delete();

        return response()->json(null, 204);
    }

}
