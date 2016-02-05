<?php

namespace App\Http\Controllers;

use DB;
use Input;
use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NearbyController extends Controller
{
    
    public function activeHaversine($latitude,$longitude,$jarak=1)
    {
        $start = microtime(true);
        $data =  DB::select('select fo.hari,fo.jam_buka,fo.jam_tutup,f.faskes_id,f.nama_faskes,f.alamat,f.latitude,f.longitude,f.tipe_id,
	 		 6371*(2*ASIN(SQRT(POWER(SIN((abs(f.latitude) - abs('.$latitude.')) * pi()/180 / 2), 2) +
			 COS(abs('.$longitude.') * pi()/180 ) * COS(abs(f.latitude) * pi()/180)
			 * POWER(SIN((f.longitude - '.$longitude.') *pi()/180 / 2), 2) ))) as jarak from faskes f
			 join faskes_open fo on fo.faskes_id = f.faskes_id

			 where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
			  AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat
			  having jarak < ' . $jarak . ' ORDER BY jarak ASC');
        $time_elapsed = microtime(true) - $start;


        return response()->json(['distance' => $jarak, 'waktu' => $time_elapsed ,'data' => $data]);
    }

    public function filterActiveHaversine($latitude,$longitude,$jarak=1,$tipe){
        $start = microtime(true);
        $data =  DB::select('select fo.hari,fo.jam_buka,fo.jam_tutup,f.faskes_id,f.nama_faskes,f.alamat,f.latitude,f.longitude,f.tipe_id,
             6371*(2*ASIN(SQRT(POWER(SIN((abs(f.latitude) - abs('.$latitude.')) * pi()/180 / 2), 2) +
             COS(abs('.$longitude.') * pi()/180 ) * COS(abs(f.latitude) * pi()/180)
             * POWER(SIN((f.longitude - '.$longitude.') *pi()/180 / 2), 2) ))) as jarak from faskes f
             join faskes_open fo on fo.faskes_id = f.faskes_id

             where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
              AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat
              AND f.tipe_id = '. $tipe.' having jarak < ' . $jarak . ' ORDER BY jarak ASC');
        $time_elapsed = microtime(true) - $start;


        return response()->json(['distance' => $jarak, 'waktu' => $time_elapsed ,'data' => $data]);
    }


    public function haversine($latitude,$longitude,$jarak=1){
        $start = microtime(true);
        $data = DB::select('select faskes_id,nama_faskes,latitude,longitude,tipe_id,alamat,
			6371*(2*ASIN(SQRT(POWER(SIN((abs(latitude) - abs('.$latitude.')) * pi()/180 / 2), 2) +
		    COS(abs('.$longitude.') * pi()/180 ) * COS(abs(latitude) * pi()/180)
		* POWER(SIN((longitude - '.$longitude.') * pi()/180 / 2), 2) ))) as jarak
		from faskes f having jarak < ' . $jarak. ' ORDER BY jarak ASC');
        $time_elapsed = microtime(true) - $start;

          return response()->json(['distance' => $jarak, 'waktu' => $time_elapsed ,'data' => $data]);
    }

    public function filterHaversine($latitude,$longitude,$jarak=1,$tipe){
        $start = microtime(true);
        $data = DB::select('select faskes_id,nama_faskes,latitude,longitude,tipe_id,alamat,
            6371*(2*ASIN(SQRT(POWER(SIN((abs(latitude) - abs('.$latitude.')) * pi()/180 / 2), 2) +
            COS(abs('.$longitude.') * pi()/180 ) * COS(abs(latitude) * pi()/180)
            * POWER(SIN((longitude - '.$longitude.') * pi()/180 / 2), 2) ))) as jarak
            from faskes f WHERE tipe_id = '.$tipe.' having jarak < ' . $jarak. ' ORDER BY jarak ASC');
        $time_elapsed = microtime(true) - $start;

        return response()->json(['distance' => $jarak, 'waktu' => $time_elapsed ,'data' => $data]);
    }



    public function activeEuclidean($latitude,$longitude,$jarak=1)
    {
        $start = microtime(true);
        $data  = DB::select('select fo.hari,fo.jam_buka,fo.jam_tutup,f.nama_faskes,f.latitude,f.longitude,
		sqrt(power(abs(f.latitude)-abs('.$latitude.'),2)+power(abs(f.longitude)-abs('.$longitude.'),2))*111.319 as jarak
		from faskes f join faskes_open fo on fo.faskes_id= f.faskes_id
		where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
		AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat 
        having jarak < ' . $jarak);
        $time_elapsed = microtime(true) - $start;
        return response()->json(['distance' => $jarak, 'waktu' => $time_elapsed ,'data' => $data]);
    }

    public function location($location, $jarak = 1)
    {
            $l = explode("," , $location);
            $latitude = $l[0];
            $longitude = $l[1];

            $start = microtime(true);
            $nearby =  DB::select('select faskes_id,nama_faskes,latitude,longitude,tipe_id,alamat,
			6371*(2*ASIN(SQRT(POWER(SIN((abs(latitude) - abs('.$latitude.')) * pi()/180 / 2), 2) +
		    COS(abs('.$longitude.') * pi()/180 ) * COS(abs(latitude) * pi()/180)
            * POWER(SIN((longitude - '.$longitude.') * pi()/180 / 2), 2) ))) as jarak
            from faskes f having jarak < ' . $jarak);
            $elapsed_time = microtime(true) - $start;

            $distance = $jarak;
            $waktu = $elapsed_time;

            return view('user.nearby', compact('nearby','location','distance','waktu'));

    }

    public function locationMaterial($location, $jarak = 1)
    {
            // dd($location);
            $l = explode("," , $location);
            $latitude = $l[0];
            $longitude = $l[1];

            $start = microtime(true);
            $nearby = DB::select('select fo.hari,fo.jam_buka,fo.jam_tutup,f.faskes_id,f.nama_faskes,f.alamat,f.latitude,f.longitude,f.tipe_id,
             6371*(2*ASIN(SQRT(POWER(SIN((abs(f.latitude) - abs('.$latitude.')) * pi()/180 / 2), 2) +
             COS(abs('.$longitude.') * pi()/180 ) * COS(abs(f.latitude) * pi()/180)
             * POWER(SIN((f.longitude - '.$longitude.') *pi()/180 / 2), 2) ))) as jarak from faskes f
             join faskes_open fo on fo.faskes_id = f.faskes_id

             where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
              AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat
               having jarak < ' . $jarak . ' ORDER BY jarak ASC');
            $elapsed_time = microtime(true) - $start;
            $distance = $jarak;
            $waktu = $elapsed_time;

            return view('material.sekitar', compact('nearby','location','distance','waktu'));
            // return view('material.nearby', compact('nearby','location','distance','waktu'));
    }

    public function detail($latlng,$faskes_id){
            $f = \App\Faskes::findOrFail($faskes_id);
            $location = $latlng;
            return view('user.detail',compact('f', 'location'));
    }

    public function materialDetail($latlng,$faskes_id){
            $f = \App\Faskes::findOrFail($faskes_id);
            $works = $f->works()->get();

            $location = $latlng;
            return view('material.detail',compact('f', 'location','works'));
    }

    public function euclidean($latitude,$longitude,$jarak=1)
    {
        $start = microtime(true);
        $data  = DB::select('select nama_faskes,latitude,longitude,sqrt(power(abs(latitude)-abs('.$latitude.'),2)
			+power(abs(longitude)-abs('.$longitude.'),2))*111.319 as jarak
		from faskes having jarak < ' . $jarak);
         $time_elapsed = microtime(true) - $start;
        return response()->json(['distance' => $jarak, 'waktu' => $time_elapsed ,'data' => $data]);

    }

    public function lokasi()
    {
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

    }

}

