<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model{


	protected $table = 'm_kota';
	protected $primaryKey = 'id_kota';
	protected $fillable = ['id_kota', 'id_provinsi','nama_kota','created_at','updated_at'];
	protected $hidden = [];
	
	public function provinsi(){
        return $this->belongsTo('App\Models\Master\Provinsi', 'id_provinsi', 'id_provinsi');
    }
}