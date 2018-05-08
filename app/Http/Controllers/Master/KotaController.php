<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Kota;


class KotaController extends Controller{

	public function __construct(){
        parent::__construct(new Kota());
    }

    public function saveKota(Request $request){
    	$input = $request->input();

    	$result = Kota::create($input);
    	if(!$result){
    		$message = env('RESPONSE_ADD_FAILED');
            return $this->renderResponse($input, false, $message);
    	}
    		$message = env('RESPONSE_ADD_SUCCESS');
            return $this->renderResponse($input, true, $message);
    }

    public function getKota(){

        $obj = new Kota();
        $primaryKey = $obj->getKeyName();

        $result = Kota::with('provinsi')->orderBy('nama_kota', 'asc')->get();
        if(isset($result)){
            $message = env('RESPONSE_GET_FAILED');
            return $this->renderResponse($result, false, $message);
        }
            $message = env('RESPONSE_GET_SUCCESS');
            return $this->renderResponse($result, true, $message);
    }
	
}