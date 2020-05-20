<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuideRest extends Model
{
    protected $table = "guide";

    protected $fillable = ['date','judul','isi','image','url','type'];

    public function getRouteKeyName()
	{
    	return 'url';
	}

}
