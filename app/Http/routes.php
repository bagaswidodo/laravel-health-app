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
    return view('user.welcome');
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

// Route::resource('auth','Auth\AuthController');
Route::controllers([
    'auth' => 'Auth\AuthController'
]);

// Route::controllers([
//     'auth' => 'Auth\AuthController',
//     'password' => 'Auth\PasswordController'
// ]);

//find nearby
Route::get('nearby/haversine/active/{latitude}/{longitude}/{jarak?}','NearbyController@activeHaversine');
Route::get('nearby/haversine/{latitude}/{longitude}/{jarak?}','NearbyController@haversine');
Route::get('nearby/{location}/{jarak?}','NearbyController@location');
Route::get('poi/detail/{faskes_id}','NearbyController@detail');
Route::get('nearby/euclidean/active/{latitude}/{longitude}/{jarak?}','NearbyController@activeEuclidean');
Route::get('nearby/euclidean/{latitude}/{longitude}/{jarak?}','NearbyController@euclidean');


