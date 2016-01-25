<?php

namespace App\Http\Controllers;

use Validator;
use App\ODokter;
use App\Dokter;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PraktekDokterFaskesController extends Controller
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
    public function index($faskes, $dokter)
    {
//        $allJadwal = ODokter::allJadwal($faskes, $dokter)->get();
        $jadwal = Dokter::find($dokter);
        $jadwal->praktek->toArray();

        $d = $this->day;

//       $jadwal = Dokter::find($dokter)->praktek->where('hari',1)->toArray();


        return view('faskes.dokter.praktek.index',compact('jadwal','d'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($faskes, $id)
    {

        $dokter = Dokter::findOrFail($id);
        return view('faskes.dokter.praktek.create', compact('dokter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hari'          => 'required',
            'jam_mulai'     => 'required|before:jam_selesai',
            'jam_selesai'   => 'required|after:jam_mulai'
        ],[
            'hari.required'         => 'Field hari tidak boleh kosong',
            'jam_mulai.required'    => 'Field jam mulai praktik tidak boleh kosong',
            'jam_selesai.required'  => 'Field jam selesai praktik tidak boleh kosong',
            'jam_mulai.before'      => 'Jam Mulai praktek tidak valid',
            'jam_selesai.after'     => 'Jam Selesai Praktek tidak valid'
        ]);

        if ($validator->fails()) {
             return redirect('faskes/'.$request->faskes_id.'/dokter/'.$request->dokter_id.'/praktek/create')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            $exist =   ODokter::where('faskes_id',$request->faskes_id)
                            ->where('dokter_id',$request->dokter_id)
                            ->where('hari', $request->hari)->count();
            if($exist > 0)
            {
                return redirect('faskes/'.$request->faskes_id.'/dokter/'.$request->dokter_id.'/praktek/create')
                        ->with('message', 'Jadwal pada hari '. $this->day[$request->hari] .' telah di inputkan !')
                        ->withInput();
            }
            else
            {
                ODokter::create($request->all());
                return redirect('faskes/'.$request->faskes_id.'/dokter/'.$request->dokter_id.'/praktek')->with('message','Data praktek berhasil ditambahkan');
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($faskes,$dokter,$hari)
    {
       
        $p = ODokter::find($dokter)->praktek($faskes,$dokter,$hari)->get();
        return view('faskes.dokter.praktek.edit',compact('p'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $faskes,$dokter,$hari)
    {
        // dd($request->all());
        $praktekDokter = ODokter::findOrFail($dokter)->praktek($faskes,$dokter,$hari);
        $validator = Validator::make($request->all(), [
            'jam_mulai'     => 'required|before:jam_selesai',
            'jam_selesai'   => 'required|after:jam_mulai'
        ],[
            'jam_mulai.required'    => 'Field jam mulai praktik tidak boleh kosong',
            'jam_selesai.required'  => 'Field jam selesai praktik tidak boleh kosong',
            'jam_mulai.before'      => 'Jam Mulai praktek tidak valid',
            'jam_selesai.after'     => 'Jam Selesai Praktek tidak valid'
        ]);

        if ($validator->fails()) {
             return redirect('/faskes/'.$faskes. '/dokter/' . $dokter . '/praktek/' . $hari . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }


        $data = [
           "faskes_id"      => $faskes,
           "dokter_id"      => $dokter,
           'hari'           => $hari,
           "jam_mulai"      => $request->jam_mulai,
           "jam_selesai"    => $request->jam_selesai

        ];
        $praktekDokter->update($data);
        return redirect('/faskes/'.$faskes. '/dokter/' . $dokter . '/praktek')->with('message','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($faskes,$dokter,$hari)
    {
        ODokter::find($dokter)->praktek($faskes,$dokter,$hari)->delete();
        return redirect('faskes/'.$faskes.'/dokter/'.$dokter.'/praktek')->with('message','Data Berhasil Dihapus');
    }
}
