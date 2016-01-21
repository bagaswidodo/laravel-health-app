<?php

namespace App\Http\Controllers;

use DB;
use App\Faskes;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OFaskes;

class FaskesOpenController extends Controller
{
    private $day = [
        0=>'Senin',
        1=>'Selasa',
        2=>'Rabu',
        3=>'Kamis',
        4=>'Jumat',
        5=>'Sabtu',
        6=>'Minggu'
    ];



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $faskes = Faskes::find($id);
        $faskes->works()->get();
        return view('faskes_open.index',compact('faskes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $faskes = Faskes::find($id);
        $faskes->works->toArray();

        $day = $this->day;
        return view('faskes_open.create',compact('faskes','day'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //how to solve invalid hadwal
        $id = $request->faskes_id;
        $day = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        ];
        $exist =   OFaskes::where('faskes_id',$id)
              ->where('hari', $request->hari)->count();

        if($exist > 0)
        {
            return redirect('faskes/' . $id . '/open/create')
                    ->with('message', 'Jadwal pada hari '. $day[$request->hari] .' telah di inputkan !')
                    ->withInput();
        }
        else
        {
            if(isset($request->jam_mulai_istirahat)){
                $data = [
                    'faskes_id' => $id,
                    'hari' => $request->hari,
                    'jam_buka' => $request->jam_buka,
                    'jam_mulai_istirahat' => $request->jam_tutup,
                    'jam_selesai_istirahat' => $request->jam_mulai_istirahat,
                    'jam_tutup' => $request->jam_selesai_istirahat
                ];
            }
            else
            {
                $data = $request->all();
            }            
        }

        OFaskes::create($data);
        return redirect('faskes/'.$request->faskes_id.'/open')->with('message','Berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $hari)
    {
        $faskesOpen = OFaskes::jadwal($id,$hari)->get();
        return view('faskes_open.foo',compact('faskesOpen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param $hari
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $hari)
    {

        $faskes = OFaskes::kodeFaskes($id)->hari($hari)->get();
        if($faskes[0]->jam_mulai_istirahat != NULL)
        {
            $tmp = [
                $faskes[0]->jam_tutup,
                $faskes[0]->jam_mulai_istirahat,
                $faskes[0]->jam_selesai_istirahat
            ];

            $faskes[0]->jam_tutup = $tmp[1] ;
            $faskes[0]->jam_selesai_istirahat =  $tmp[0];
            $faskes[0]->jam_mulai_istirahat = $tmp[2];
           
        }
        // dd($data);
        return view('faskes_open/edit',compact('faskes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $hari)
    {
        //
        $faskes = OFaskes::kodeFaskes($id)->hari($hari);
        if(isset($request->jam_mulai_istirahat)){
            $faskesOpen = [
                'faskes_id' => $id,
                'hari' => $request->hari,
                'jam_buka' => $request->jam_buka,
                'jam_mulai_istirahat' => $request->jam_tutup,
                'jam_selesai_istirahat' => $request->jam_mulai_istirahat,
                'jam_tutup' => $request->jam_selesai_istirahat
            ];
        }
        else
        {
            // $faskesOpen = $request->all();
            $faskesOpen = [
                  "faskes_id" => $id,
                  "hari" => $request->hari,
                  "jam_buka" => $request->jam_buka,
                  "jam_tutup" => $request->jam_tutup
            ];
            // dd($request->all());
        }    
        $faskes->update($faskesOpen);
        return redirect('faskes/' . $id . '/open')->with('message', 'Data berhasil diUbah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $hari)
    {
        //
         OFaskes::kodeFaskes($id)->hari($hari)->delete();
        return redirect('faskes/' . $id . '/open')->with('message', 'Data berhasil diUbah');

    }
}
