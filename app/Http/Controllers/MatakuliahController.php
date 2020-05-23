<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Matakuliah;

class MatakuliahController extends Controller
{
    
	public function index()
    {
        return Matakuliah::all();
    }

    public function show($hari, $time)
    {

        $matkul=Matakuliah::where('hari','=',$hari)
        ->whereTime('jam_mulai', '<=', $time)
        ->whereTime('jam_selesai', '>=', $time)
        ->get();

        return response()->json($matkul, 200);

    }

    public function store(Request $request)
    {
        $guide = Matakuliah::create($request->all());

        return response()->json($guide, 201);
    }

    public function update(Request $request, Matakuliah $guide)
    {
        $guide->update($request->all());

        return response()->json($guide, 200);
    }

    public function delete(Matakuliah $guide)
    {
        $guide->delete();

        return response()->json(null, 204);
    }

}
