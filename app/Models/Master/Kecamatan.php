<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model{


	protected $table = 'm_kecamatan';
	protected $primaryKey = 'id_kecamatan';
	protected $fillable = ['id_kecamatan','id_kota','id_provinsi','nama_kecamatan','created_at','updated_at'];
	
	public function kota(){
        return $this->belongsTo('App\Models\Master\Kota', 'id_kota');
    }

    public function provinsi(){
        return $this->belongsTo('App\Models\Master\Provinsi', 'id_provinsi');
    }
}