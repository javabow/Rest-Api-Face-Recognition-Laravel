<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{

	//lock untuk table dalam database
	protected $table = "matakuliah";

	//lock untuk fill yang bisa diisi dalam table yang dipilih
	protected $fillable = ['kode_matkul','nama_matkul','hari','jam_mulai','jam_selesai'];

	public function getRouteKeyName()
	{
  
	}

	 //  Route::bind('matakuliah', function($hari, $time) {
		 //     return \App\Product::where('kode_matkul', $kode)->whereDate('jam_mulai', '<=', $time)->whereDate('jam_selesai', '>=', $time)->first();
		 // });

}
