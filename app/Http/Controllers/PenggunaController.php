<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//call model Pengguna
use App\Pengguna;

class PenggunaController extends Controller
{
    public function index()
    {

    	//Mengambil Semua data pengguna
    	$pengguna = Pengguna::all();

    	// return data ke view
    	return view('pengguna', ['pengguna' => $pengguna]);

    }
}
