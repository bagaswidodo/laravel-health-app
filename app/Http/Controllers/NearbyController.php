<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NearbyController extends Controller
{
    //
    public function activeHaversine($latitude,$longitude,$jarak=1)
    {
        return DB::select('select fo.hari,fo.jam_buka,fo.jam_tutup,f.faskes_id,f.nama_faskes,f.alamat,f.latitude,f.longitude,f.tipe_id,
	 		 6371*(2*ASIN(SQRT(POWER(SIN((abs(f.latitude) - abs('.$latitude.')) * pi()/180 / 2), 2) +
			 COS(abs('.$longitude.') * pi()/180 ) * COS(abs(f.latitude) * pi()/180)
			 * POWER(SIN((f.longitude - '.$longitude.') *pi()/180 / 2), 2) ))) as jarak from faskes f
			 join faskes_open fo on fo.faskes_id = f.faskes_id

			 where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
			  AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat
			  having jarak < ' . $jarak);
    }

    public function haversine($latitude,$longitude,$jarak=1){
        return DB::select('select faskes_id,nama_faskes,latitude,longitude,tipe_id,alamat,
			6371*(2*ASIN(SQRT(POWER(SIN((abs(latitude) - abs('.$latitude.')) * pi()/180 / 2), 2) +
		    COS(abs('.$longitude.') * pi()/180 ) * COS(abs(latitude) * pi()/180)
		* POWER(SIN((longitude - '.$longitude.') * pi()/180 / 2), 2) ))) as jarak
		from faskes f having jarak < ' . $jarak);
    }

    public function activeEuclidean($latitude,$longitude,$jarak=1)
    {
        return DB::select('select fo.hari,fo.jam_buka,fo.jam_tutup,f.nama_faskes,f.latitude,f.longitude,
		sqrt(power(abs(f.latitude)-abs('.$latitude.'),2)+power(abs(f.longitude)-abs('.$longitude.'),2))*111.319 as jarak
		from faskes f
		join faskes_open fo on fo.faskes_id= f.faskes_id

		where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
		AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat having jarak < ' . $jarak);

    }

    public function location($location, $jarak = 1)
    {
            $l = explode("," , $location);
            $latitude = $l[0];
            $longitude = $l[1];

            $nearby =  DB::select('select faskes_id,nama_faskes,latitude,longitude,tipe_id,alamat,
			6371*(2*ASIN(SQRT(POWER(SIN((abs(latitude) - abs('.$latitude.')) * pi()/180 / 2), 2) +
		    COS(abs('.$longitude.') * pi()/180 ) * COS(abs(latitude) * pi()/180)
            * POWER(SIN((longitude - '.$longitude.') * pi()/180 / 2), 2) ))) as jarak
            from faskes f having jarak < ' . $jarak);

            return view('user.nearby', compact('nearby','location'));

    }

    public function detail($faskes_id){
            $f = \App\Faskes::findOrFail($faskes_id);
            return view('user.detail',compact('f'));
    }

    public function euclidean($latitude,$longitude,$jarak=1)
    {
        return DB::select('select nama_faskes,latitude,longitude,sqrt(power(abs(latitude)-abs('.$latitude.'),2)
			+power(abs(longitude)-abs('.$longitude.'),2))*111.319 as jarak
		from faskes having jarak < ' . $jarak);

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

