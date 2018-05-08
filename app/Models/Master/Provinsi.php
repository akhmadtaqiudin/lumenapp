<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model{


	protected $table = 'm_provinsi';
	protected $primaryKey = 'id_provinsi';
	protected $fillable = ['id_provinsi','nama_provinsi','created_at','updated_at'];
}
