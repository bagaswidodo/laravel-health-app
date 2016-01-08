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
        $faskes->works->toArray();
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
//        dd($faskes->toArray());
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

//        dd($request->all());
        OFaskes::create($request->all());
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
        //
//        $faskesOpen = OFaskes::findOrFail($id);
//        $faskesOpen = OFaskes::kodeFaskes($id)->hari($hari)->get();
        $faskesOpen = OFaskes::jadwal($id,$hari)->get();
        return view('faskes_open.foo',compact('faskesOpen'));


       // $faskes = Faskes::findOrFail($id);//join better temporary use this
//        return view('faskes_open.index',compact('faskesOpen'));
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
        //dd($request['hari']);
       // $faskesOpen = $request->all();
        $faskes = OFaskes::kodeFaskes($id)->hari($hari);
        $faskesOpen['jam_buka'] = $request['jam_buka'];
        $faskesOpen['jam_tutup'] = $request['jam_tutup'];
        $faskesOpen['jam_mulai_istirahat'] = $request['jam_mulai_istirahat'];
        $faskesOpen['jam_selesai_istirahat'] = $request['jam_selesai_istirahat'];
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
