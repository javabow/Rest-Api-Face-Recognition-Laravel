<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsensiRest extends Model
{
    
	//lock untuk table dalam database
	protected $table = "absensi";

	//lock untuk fill yang bisa diisi dalam table yang dipilih
	protected $fillable = ['kode_matkul','nim','kode_kelas','tanggal_absen'];

	public function getRouteKeyName()
	{
  
	}

}
