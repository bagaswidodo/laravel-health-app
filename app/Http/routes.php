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
//    return view('user.nearby');
    return view('user.welcome');
});

Route::get('lokasi',function(){
    $term = Input::get('term');
    $lokasi = DB::table("lokasi")->where('nama', 'LIKE', '%' . $term.'%')->get(); //find by location

    $msg = [];
    foreach($lokasi as $v)
    {
        $data['value'] = $v->nama;
        $data['id'] = $v->latitude . "," . $v->longitude;
        array_push($msg, $data);
    }
   return Response::json([
       'response' => true,
       'message' => $msg
   ],200);
});

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
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

Route::get('praktek/{f}',function($f){
    $faskes = \App\Faskes::findOrFail($f);

//    $faskes->dokter()->detach([2 => ['hari' => 2,'jam_mulai'=>'17:00:00','jam_selesai'=>'19:00:00']]);
    $faskes->dokter()->attach([
        2 => ['hari' => 2,'jam_mulai'=>'17:00:00','jam_selesai'=>'19:00:00']
    ]);
    $faskes->dokter()->attach([
        2 => ['hari' => 3,'jam_mulai'=>'17:00:00','jam_selesai'=>'19:00:00']
    ]);

});

//find nearby
Route::get('nearby/haversine/active/{latitude}/{longitude}/{jarak?}','NearbyController@nearbyHaversine');
Route::get('nearby/haversine/{latitude}/{longitude}/{jarak?}','NearbyController@haversine');
Route::get('nearby/{location}/{jarak?}',function($location, $jarak = 1){
    $l = explode("," , $location);
    $latitude = $l[0];
    $longitude = $l[1];

    $nearby =  DB::select('select faskes_id,nama_faskes,latitude,longitude,tipe_id,alamat,
			6371*(2*ASIN(SQRT(POWER(SIN((abs(latitude) - abs('.$latitude.')) * pi()/180 / 2), 2) +
		    COS(abs('.$longitude.') * pi()/180 ) * COS(abs(latitude) * pi()/180)
		* POWER(SIN((longitude - '.$longitude.') * pi()/180 / 2), 2) ))) as jarak
		from faskes f having jarak < ' . $jarak);

        return view('user.nearby', compact('nearby','location'));
});

Route::get('poi/detail/{faskes_id}',function($faskes_id){
    $f = \App\Faskes::findOrFail($faskes_id);
    return view('user.detail',compact('f'));
});


Route::get('nearby/euclidean/active/{latitude}/{longitude}/{jarak?}',function($latitude,$longitude,$jarak=1){
    return DB::select('select fo.hari,fo.jam_buka,fo.jam_tutup,f.nama_faskes,f.latitude,f.longitude,
		sqrt(power(abs(f.latitude)-abs('.$latitude.'),2)+power(abs(f.longitude)-abs('.$longitude.'),2))*111.319 as jarak
		from faskes f
		join faskes_open fo on fo.faskes_id= f.faskes_id

		where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
		AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat having jarak < ' . $jarak);
});

Route::get('nearby/euclidean/{latitude}/{longitude}/{jarak?}',function($latitude,$longitude,$jarak=1){

    return DB::select('select nama_faskes,latitude,longitude,sqrt(power(abs(latitude)-abs('.$latitude.'),2)
			+power(abs(longitude)-abs('.$longitude.'),2))*111.319 as jarak
		from faskes having jarak < ' . $jarak);
});


