<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mahasiswa;

class MahasiswaController extends Controller
{
    
	public function index()
    {
        return Mahasiswa::all();
    }

    public function show(Mahasiswa $id)
    {

        return $id;
    }

    public function store(Request $request)
    {
        $guide = Mahasiswa::create($request->all());

        return response()->json($guide, 201);
    }

    public function update(Request $request, Mahasiswa $guide)
    {
        $guide->update($request->all());

        return response()->json($guide, 200);
    }

    public function delete(Mahasiswa $guide)
    {
        $guide->delete();

        return response()->json(null, 204);
    }

}
