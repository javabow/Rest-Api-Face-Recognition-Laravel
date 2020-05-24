<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KrsRest extends Model
{
    
	//lock untuk table dalam database
	protected $table = "krs";

	//lock untuk fill yang bisa diisi dalam table yang dipilih
	protected $fillable = ['kode_matkul','nim','kode_kelas'];

	public function getRouteKeyName()
	{
  
	}

}
