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

    public function search($query)
    {

        $result = Mahasiswa::like('nama', $query)->get();

        return $result;
    }

    public function store(Request $request)
    {
        $guide = Mahasiswa::create($request->all());

        return response()->json($guide, 201);
    }

    public function update(Request $request, $id)
    {

        $result = Mahasiswa::whereId($id)->update($request->all());

        return response()->json($result, 200);
    }

    public function delete($id)
    {
        $result = Mahasiswa::whereId($id)->delete();

        return response()->json(null, 204);
    }

}
