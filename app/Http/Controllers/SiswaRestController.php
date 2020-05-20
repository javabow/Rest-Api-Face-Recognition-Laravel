<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SiswaRest;

class SiswaRestController extends Controller
{
    
	public function index(){

		return SiswaRest::all();

	}

	public function create(request $request){

		$siswa = new SiswaRest;
		$siswa->nama = $request->nama;
		$siswa->alamat = $request->alamat;
		$siswa->save();

		return "Data Berhasil Masuk";

	}

	public function update(request $request, $id){

		$nama = $request->nama;
		$alamat = $request->alamat;

		$siswa = SiswaRest::find($id);
		$siswa->nama = $nama;
		$siswa->alamat = $alamat;
		$siswa->save();

		return "Data Berhasil Updated";

	}

	public function delete($id){

		$siswa = SiswaRest::find($id);
		$siswa->delete();

		return "Successfully Deleted";

	}

}
