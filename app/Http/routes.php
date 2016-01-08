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

//find nearby filter
Route::get('nearby/haversine/active/{latitude}/{longitude}/{jarak?}/filter/{tipe}','NearbyController@filterActiveHaversine');
Route::get('nearby/haversine/{latitude}/{longitude}/{jarak?}/filter/{tipe}','NearbyController@filterHaversine');

Route::get('nearby/{location}/{jarak?}','NearbyController@location');
Route::get('poi/detail/{latlng}/{faskes_id}','NearbyController@detail');
Route::get('nearby/euclidean/active/{latitude}/{longitude}/{jarak?}','NearbyController@activeEuclidean');
Route::get('nearby/euclidean/{latitude}/{longitude}/{jarak?}','NearbyController@euclidean');

Route::get('benchmark/{latitude}/{longitude}',function($latitude,$longitude){
	//haversine


	 	$hstart = microtime(true);
        $hdata = DB::select('select faskes_id,nama_faskes,latitude,longitude,tipe_id,alamat,
			6371*(2*ASIN(SQRT(POWER(SIN((abs(latitude) - abs('.$latitude.')) * pi()/180 / 2), 2) +
		    COS(abs('.$longitude.') * pi()/180 ) * COS(abs(latitude) * pi()/180)
		* POWER(SIN((longitude - '.$longitude.') * pi()/180 / 2), 2) ))) as jarak
		from faskes f having jarak < 1 ORDER BY jarak ASC');
        $htime_elapsed = microtime(true) - $hstart;
        $haversine = ['data' =>$hdata,'time_elapsed' =>$htime_elapsed];


        //euclidean
        $estart = microtime(true);
        $edata  = DB::select('select nama_faskes,latitude,longitude,sqrt(power(abs(latitude)-abs('.$latitude.'),2)
			+power(abs(longitude)-abs('.$longitude.'),2))*111.319 as jarak
		from faskes having jarak < 1 ORDER BY jarak ASC');
        $etime_elapsed = microtime(true) - $estart;
        $euclidean = ['data' => $edata,'time_elapsed' => $etime_elapsed];


          // return response()->json(compact('haversine','euclidean'));
       return view('benchmark.index',compact('haversine','euclidean'));





	//return view('benchmark.index');
});
