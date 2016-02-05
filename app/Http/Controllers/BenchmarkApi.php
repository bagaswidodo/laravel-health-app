<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BenchmarkApi extends Controller
{
    function allApi($latitude,$longitude){
        //haversine
        $hbeginMemory = memory_get_usage();
        $hstart = microtime(true);
        $hdata = DB::select('select faskes_id,nama_faskes,latitude,longitude,tipe_id,alamat,
            6371*(2*ASIN(SQRT(POWER(SIN((abs(latitude) - abs('.$latitude.')) * pi()/180 / 2), 2) +
            COS(abs('.$longitude.') * pi()/180 ) * COS(abs(latitude) * pi()/180)
        * POWER(SIN((longitude - '.$longitude.') * pi()/180 / 2), 2) ))) as jarak
        from faskes f having jarak < 1 ORDER BY jarak ASC');
        $htime_elapsed = microtime(true) - $hstart;
        $hendMemory = memory_get_usage() - $hbeginMemory;
        $haversine = ['data' =>$hdata,'time_elapsed' =>$htime_elapsed, 'memory_usage' => $hendMemory];

        //euclidean
        $estart = microtime(true);
        $ebeginMemory = memory_get_usage();
        $edata  = DB::select('select nama_faskes,latitude,longitude,sqrt(power(abs(latitude)-abs('.$latitude.'),2)
            +power(abs(longitude)-abs('.$longitude.'),2))*111.319 as jarak
        from faskes having jarak < 1 ORDER BY jarak ASC');
        $etime_elapsed = microtime(true) - $estart;
        $eMemory = memory_get_usage() - $hbeginMemory;
        $euclidean = ['data' => $edata,'time_elapsed' => $etime_elapsed, 'memory_usage' => $eMemory];

        return response()->json(compact('haversine','euclidean'));//return to JSON data
        // return view('benchmark.index',compact('haversine','euclidean')); //return to a page
    }

    function allOpenApi($latitude,$longitude,$jarak=1)
    {
        //haversine
        $hbeginMemory = memory_get_usage();
        $hstart = microtime(true);
        $hdata = DB::select('select fo.hari,fo.jam_buka,fo.jam_tutup,f.faskes_id,f.nama_faskes,f.alamat,f.latitude,f.longitude,f.tipe_id,
             6371*(2*ASIN(SQRT(POWER(SIN((abs(f.latitude) - abs('.$latitude.')) * pi()/180 / 2), 2) +
             COS(abs('.$longitude.') * pi()/180 ) * COS(abs(f.latitude) * pi()/180)
             * POWER(SIN((f.longitude - '.$longitude.') *pi()/180 / 2), 2) ))) as jarak from faskes f
             join faskes_open fo on fo.faskes_id = f.faskes_id

             where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
              AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat
              having jarak < '.$jarak.' ORDER BY jarak ASC');
        $htime_elapsed = microtime(true) - $hstart;
        $hendMemory = memory_get_usage() - $hbeginMemory;
        $haversine = ['data' =>$hdata,'time_elapsed' =>$htime_elapsed, 'memory_usage' => $hendMemory];

        //euclidean
        $estart = microtime(true);
        $ebeginMemory = memory_get_usage();
        $edata  = DB::select('select fo.hari,fo.jam_buka,fo.jam_tutup,f.nama_faskes,f.latitude,f.longitude,
        sqrt(power(abs(f.latitude)-abs('.$latitude.'),2)+power(abs(f.longitude)-abs('.$longitude.'),2))*111.319 as jarak
        from faskes f join faskes_open fo on fo.faskes_id= f.faskes_id
        where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
        AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat 
        having jarak < '.$jarak.' ORDER BY jarak ASC');
        $etime_elapsed = microtime(true) - $estart;
        $eMemory = memory_get_usage() - $hbeginMemory;
        $euclidean = ['data' => $edata,'time_elapsed' => $etime_elapsed, 'memory_usage' => $eMemory];

        // return view('benchmark.index',compact('haversine','euclidean'));//return to page
        return response()->json(compact('haversine','euclidean'));//return to JSON data


    }

}
