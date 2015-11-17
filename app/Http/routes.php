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
    //return view('welcome');
    return view('user.nearby');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('tipe', 'TipeController');
    Route::resource('faskes', 'FaskesController');
    Route::resource('faskes.open', 'FaskesOpenController');
    Route::resource('faskes.dokter', 'FaskesDokterController');
    Route::resource('faskes.dokter.praktek', 'PraktekDokterFaskesController');
//    Route::resource('dokter', 'DokterController');
});

Route::get('dashboard',['middleware' => 'auth', function(){
   return view('admin.index');
}]);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

//Route::group(['prefix'=>'/api/v1'],function(){
//    //api route
//
//});

Route::get('praktek/{f}',function($f){
    $faskes = \App\Faskes::findOrFail($f);

//    $faskes->dokter()->detach([2 => ['hari' => 2,'jam_mulai'=>'17:00:00','jam_selesai'=>'19:00:00']]);
    $faskes->dokter()->attach([
        2 => ['hari' => 2,'jam_mulai'=>'17:00:00','jam_selesai'=>'19:00:00']
    ]);
    $faskes->dokter()->attach([
        2 => ['hari' => 3,'jam_mulai'=>'17:00:00','jam_selesai'=>'19:00:00']
    ]);
//    $faskes->dokter()->detach(2);

    /**
     * detaching
     */
//    $whereArray = array('dokter_id' => 2,'faskes_id' => 6,'hari' => 2);
//
//    $query = DB::table('dokter_faskes');
//    foreach($whereArray as $field => $value) {
//        $query->where($field, $value);
//    }
//    return $query->delete();



//    return 'dokter_praktek_attached';
});