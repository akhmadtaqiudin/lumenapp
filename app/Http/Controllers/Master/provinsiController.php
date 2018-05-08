<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Provinsi;


class ProvinsiController extends Controller{

  public function __construct(){
        parent::__construct(new Provinsi());
    }

    public function saveProvinsi(Request $request){
      $input = $request->input();

      $result = Provinsi::create($input);
      if(!$result){
        $message = env('RESPONSE_ADD_FAILED');
            return $this->renderResponse($input, false, $message);
      }
        $message = env('RESPONSE_ADD_SUCCESS');
            return $this->renderResponse($input, true, $message);
    }
  
}