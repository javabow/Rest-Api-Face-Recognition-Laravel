<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    //note
    // php artisan down, untuk mengaktifkan mode maintenance
    // php artisan up, nonaktif mode maintenance

	public function index()
    {
    	// mengambil data dari table pegawai
    	$pegawai = DB::table('pegawai')->paginate(10);
 
    	// mengirim data pegawai ke view index
    	return view('index',['pegawai' => $pegawai]);
 
    }

    ///Contoh Validasi
    public function input()
    {
        return view('input');
    }
 
    public function proses(Request $request)
    {
    	$messages = [
		    'required' => ':attribute wajib diisi cuy!!!',
		    'min' => ':attribute harus diisi minimal :min karakter ya cuy!!!',
		    'max' => ':attribute harus diisi maksimal :max karakter ya cuy!!!',
		];

        $this->validate($request,[
           'nama' => 'required|min:5|max:20',
           'pekerjaan' => 'required',
           'usia' => 'required|numeric'
        ],$messages);
 
        return view('proses',['data' => $request]);
    }
    ///

    public function tambah()
	{
 
		// memanggil view tambah
		return view('tambah');
 
	}

	public function edit($id)
	{
	
		// mengambil data pegawai berdasarkan id yang dipilih
		$pegawai = DB::table('pegawai')->where('pegawai_id',$id)->get();
		
		// passing data pegawai yang didapat ke view edit.blade.php
		return view('edit',['pegawai' => $pegawai]);
 
	}

	// method untuk hapus data pegawai
	public function hapus($id)
	{
		// menghapus data pegawai berdasarkan id yang dipilih
		DB::table('pegawai')->where('pegawai_id',$id)->delete();
			
		// alihkan halaman ke halaman pegawai
		return redirect('/pegawai');
	}

	// update data pegawai
	public function update(Request $request)
	{
		// update data pegawai
		DB::table('pegawai')->where('pegawai_id',$request->id)->update([
			'pegawai_nama' => $request->nama,
			'pegawai_jabatan' => $request->jabatan,
			'pegawai_umur' => $request->umur,
			'pegawai_alamat' => $request->alamat
		]);
		
		// alihkan halaman ke halaman pegawai
		return redirect('/pegawai');
	}

	public function cari(Request $request)
	{
		// menangkap data pencarian
		$key = $request->key;
 
    		// mengambil data dari table pegawai sesuai pencarian data
		$pegawai = DB::table('pegawai')
		->where('pegawai_nama','like',"%".$key."%")
		->paginate();
 
    		// mengirim data pegawai ke view index
		return view('index',['pegawai' => $pegawai]);
 
	}

	public function store(Request $request)
	{

		// insert data ke table pegawai
		$test = DB::table('pegawai')->insert([
		
			'pegawai_nama' => $request->nama,
			'pegawai_jabatan' => $request->jabatan,
			'pegawai_umur' => $request->umur,
			'pegawai_alamat' => $request->alamat
		
		]);

		// alihkan halaman ke halaman pegawai
		if ($test) {
			$notice = 'Sukses menambahkan data';
		}else{
			$notice = 'Gagal menambahkan data';
		}

		return redirect('pegawai')->with('status', $notice);
		
	 
	}

    public function formulir(){

    	return view('formulir');

	}

	// public function proses(Request $request){
    
 //        $nama = $request->input('nama');
 //     	$alamat = $request->input('alamat');
 //     	$nomorHP = $request->input('hp');
    
 //        return "Nama : ".$nama.", Alamat : ".$alamat.", Nomor HP : ".$nomorHP;
	// }

}