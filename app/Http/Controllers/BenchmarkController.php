<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BenchmarkController extends Controller
{
    function all($latitude,$longitude){
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
    }


}
