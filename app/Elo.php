<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elo extends Model
{
    //lock untuk table dalam database
	protected $table = 'guide';

	//lock untuk fill yang bisa diisi dalam table yang dipilih
	protected $fillable = ['date','judul','isi','image','url','type'];

	//lock untuk fill yang tidak boleh diisi dalam table
	//protected $guarded = [''];

}
