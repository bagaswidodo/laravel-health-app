<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    // return view('user.welcome');
	return view('material.home');
});

Route::get('/home',function(){
	redirect('/faskes');
});

Route::get('lokasi','NearbyController@lokasi');
Route::group(['middleware' => 'auth'], function () {
    Route::resource('tipe', 'TipeController');
    Route::resource('faskes', 'FaskesController');
    Route::resource('faskes.open', 'FaskesOpenController');
    Route::resource('faskes.dokter', 'FaskesDokterController');
    Route::resource('faskes.dokter.praktek', 'PraktekDokterFaskesController');
});

Route::get('dashboard',['middleware' => 'auth', function(){
   return view('admin.index');
}]);

Route::controllers([
    'auth' => 'Auth\AuthController'
]);

Route::group(['prefix' => 'nearby'], function(){
	Route::get('euclidean/active/{latitude}/{longitude}/{jarak?}','NearbyController@activeEuclidean');
	Route::get('euclidean/{latitude}/{longitude}/{jarak?}','NearbyController@euclidean');
	Route::get('haversine/active/{latitude}/{longitude}/{jarak?}','NearbyController@activeHaversine');
	Route::get('haversine/{latitude}/{longitude}/{jarak?}','NearbyController@haversine');
	Route::get('haversine/active/{latitude}/{longitude}/{jarak?}/filter/{tipe}','NearbyController@filterActiveHaversine');
	Route::get('haversine/{latitude}/{longitude}/{jarak?}/filter/{tipe}','NearbyController@filterHaversine');
	Route::get('{location}/{jarak?}','NearbyController@location');
});


Route::get('material',function(){
	return view('material.home');
});
Route::get('material/nearby/{location}/{jarak?}','NearbyController@locationMaterial');
Route::get('material/detail/{latlng}/{faskes_id}','NearbyController@materialDetail');
Route::get('poi/detail/{latlng}/{faskes_id}','NearbyController@detail');

Route::get('benchmark/all/{latitude}/{longitude}','BenchmarkController@all');
Route::get('benchmark/active/{latitude}/{longitude}/{jarak?}','BenchmarkController@allOpen');

//Routes for API
Route::group(['prefix' => 'api'], function () {
	Route::get('nearby/haversine/active/{latitude}/{longitude}/{jarak?}','NearbyController@activeHaversine');
	Route::get('nearby/haversine/{latitude}/{longitude}/{jarak?}','NearbyController@haversine');

	//find nearby filter
	Route::get('nearby/haversine/active/{latitude}/{longitude}/{jarak?}/filter/{tipe}','NearbyController@filterActiveHaversine');
	Route::get('nearby/haversine/{latitude}/{longitude}/{jarak?}/filter/{tipe}','NearbyController@filterHaversine');

	Route::get('all/{latitude}/{longitude}','BenchmarkApi@allApi');
	Route::get('active/{latitude}/{longitude}/{jarak?}','BenchmarkApi@allOpenApi');

	Route::get('dokter/praktek/{id}','DokterController@jadwal');
});
