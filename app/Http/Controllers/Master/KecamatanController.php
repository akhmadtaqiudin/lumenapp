<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Kecamatan;


class KecamatanController extends Controller{

	public function __construct(){
        parent::__construct(new Kecamatan());
    }

    public function saveKecamatan(Request $request){
    	$input = $request->input();

    	$result = Kecamatan::create($input);
    	if(!$result){
    		$message = env('RESPONSE_ADD_FAILED');
            return $this->renderResponse($input, false, $message);
    	}
    		$message = env('RESPONSE_ADD_SUCCESS');
            return $this->renderResponse($input, true, $message);
    }

    public function getKecamatan(){

        $obj = new Kecamatan();
        $primaryKey = $obj->getKeyName();

        $result = Kecamatan::with(['kota','provinsi'])->orderBy('nama_kecamatan', 'asc')->get();
        if(isset($result)){
            $message = env('RESPONSE_GET_FAILED');
            return $this->renderResponse($result, false, $message);
        }
            $message = env('RESPONSE_GET_SUCCESS');
            return $this->renderResponse($result, true, $message);
    }
	
}