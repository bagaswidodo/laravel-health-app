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

    public function activeEuclidean()
    {

    }

}

