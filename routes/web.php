<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });
$router->group(['prefix' => 'api/master'], function($router){

	/* provinsi */
	$router->get('/provinsi', 'Master\ProvinsiController@getAll');
	$router->get('/provinsi/{id}', 'Master\ProvinsiController@getById');
	$router->post('/provinsi', 'Master\ProvinsiController@saveProvinsi');
	$router->put('/provinsi', 'Master\ProvinsiController@update');
	$router->delete('/provinsi/{id}', 'Master\ProvinsiController@delete');

	/* kota */
	$router->get('/kota', 'Master\KotaController@getKota');
	$router->get('/kota/{id}', 'Master\KotaController@getById');
	$router->post('/kota', 'Master\KotaController@saveKota');
	$router->put('/kota', 'Master\KotaController@update');
	$router->delete('/kota/{id}', 'Master\KotaController@delete');

	/* Kecamatan */
	$router->get('/kecamatan', 'Master\KecamatanController@getKecamatan');
	$router->get('/kecamatan/{id}', 'Master\KecamatanController@getById');
	$router->post('/kecamatan', 'Master\KecamatanController@saveKecamatan');
	$router->put('/kecamatan', 'Master\KecamatanController@update');
	$router->delete('/kecamatan/{id}', 'Master\KecamatanController@delete');
});
