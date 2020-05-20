<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// panggil model pegawai
use App\Siswa;
 
class SiswaController extends Controller
{
    public function index()
    {


    	// mengambil data pegawai
    	$siswa = Siswa::where('id', '=' , 10)->get();
    	//->paginate(10);
 
    	//$siswa2 = $siswa::paginate(10);

    	// mengirim data pegawai ke view pegawai
    	return view('siswa', ['siswa' => $siswa]);
    }
 
}