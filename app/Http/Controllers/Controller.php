<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Validator;

class Controller extends BaseController
{
    public $model;

    protected function __construct($model){
    	$this->model = $model;
    }
	
	public function renderResponse($result,$success,$message){
		$res['Result'] = $result;
		$res['success'] = $success;
		$res['message'] = $message;
		return response($res);
	}

    public function create(Request $request){

		$model = $this->model;
        $input = $request->input();
		$rules = $model->getRules();

		$validator = Validator::make($input, $rules);
		if($validator->fails()){
			$error = $validator->messages()->toJson();
			return $this->renderResponse($input,false,$error);
		}

		$foreignKeys = is_null($model->getForeignKeys())?[]:$model->getForeignKeys();
        $primaryKey = $model->getKeyName();
        $fillable = is_null($model->getFillable())?[]:$model->getFillable();
		$hash = is_null($model->getHash())?[]:$model->getHash();

		foreach($hash as $f => $v){
			if(isset($input[$v])){
				$model->$v = $input[$v];
			}
		}
		foreach($foreignKeys as $f => $v){
			if(isset($input[$v])){
				$model->$v = $input[$v];
			}
		}
		foreach($fillable as $f => $v){
			if(isset($input[$v])){
				$model->$v = $input[$v];
			}
		}

		$save = $model->save();
        if ($save) {
        	$message = env('RESPONSE_SAVE_SUCCESS');
			return $this->renderResponse($model, true, $message);
        }else{
        	$message = env('RESPONSE_SAVE_FAILED');
            return $this->renderResponse($input, false, $message);
        }
	}
	
	
	public function update(Request $request){

		$model = $this->model;
        $input = $request->input();
		$rules = $model->getRules();

		$validator = Validator::make($input, $rules);
		if($validator->fails()){
			$error = $validator->messages()->toJson();
			return $this->renderResponse($input,false,$error);
		}
		
		$foreignKeys = is_null($model->getForeignKeys())?[]:$model->getForeignKeys();
        $primaryKey = $model->getKeyName();
        $fillable = is_null($model->getFillable())?[]:$model->getFillable();
		$model = $model->find($input[$primaryKey]);
		
		foreach($foreignKeys as $f => $v){
			if(isset($input[$v])){
				$model->$v = $input[$v];
			}
		}
		foreach($fillable as $f => $v){
			if(isset($input[$v])){
				$model->$v = $input[$v];
			}
		}
		
		$save = $model->save();
        if ($save) {
        	$message = env('RESPONSE_UPDATE_SUCCESS');
			return $this->renderResponse($model, true, $message);
        }else{
        	$message = env('RESPONSE_UPDATE_FAILED');
            return $this->renderResponse($input, false, $message);
        }
	}

	public function delete($id){

		$model = $this->model;
		$primaryKey = $model->getKeyName();
		$model = $model->find($id);

		$delete =  $model->delete();
		if ($delete) {
			$message = env('RESPONSE_DELETE_SUCCESS');
			return $this->renderResponse($model, true, $message);
        }else{
        	$message = env('RESPONSE_DELETE_FAILED');
            return $this->renderResponse($model, false, $message);
        }
	}

	public function getAll(){

		$model = $this->model;
		$primaryKey = $model->getKeyName();
        $result = $model->get();

        if(empty($result)||count($result)<=0){
            $message = env('RESPONSE_GET_FAILED');
            return $this->renderResponse($result, false, $message);
        }
	        $message = env('RESPONSE_GET_SUCCESS');
	        return $this->renderResponse($result, true, $message);
	}
	
	public function getById($id){

		$model = $this->model;
		$primaryKey = $model->getKeyName();
        $result = $model->find($id);

        if($result==null){
            $message = env('RESPONSE_GET_FAILED');
            return $this->renderResponse($id, false, $message);
        }
	        $message = env('RESPONSE_GET_SUCCESS');
	        return $this->renderResponse($result, true, $message);
	}

	public function getLimit($start,$limit){

		$model = $this->model;
		$primaryKey = $model->getKeyName();
        $result = $model->offset($start)->limit($limit)->get();

        if(!isset($result[0]->$primaryKey)){
            $message = env('RESPONSE_GET_FAILED');
            $result = null;
            return renderResponse($result, false, $message);
        }
	        $message = env('RESPONSE_GET_SUCCESS');
	        return $this->renderResponse($result, true, $message);
	}
	
	public function count(){

		$model = $this->model;
		$primaryKey = $model->getKeyName();
        $result = $model->count();

        if($result==null){
            $message = env('RESPONSE_GET_FAILED');
            return $this->renderResponse($result, false, $message);
        }
	        $message = env('RESPONSE_GET_SUCCESS');
	        return $this->renderResponse($result, true, $message);
	}
}
