<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaskesRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Faskes;
use App\Tipe;
use Auth;
use Validator;

class FaskesController extends Controller
{
    private  $faskesTipe = [
        null => 'Pilih Tipe',
        1 => "Rumah Sakit",
        2 => "Klinik",
        3 => "Puskesmas",
        4 => "Dokter Umum",
        5 => "Dokter Spesialis",
        6 => "Dokter gigi",
        7 => "Bidan"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $f = Auth::user()->faskes()->paginate(10);
       return view('faskes.index',compact('f'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $t = $this->faskesTipe;
        return view('faskes.create',compact('t'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaskesRequest $request)
    {
        // dd($request->all());
        Faskes::create($request->all());
        return redirect('faskes')->with('message','Data Faskes di tambahkan');
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
    public function edit($id)
    {
        $f = Faskes::find($id);
       // $t = Tipe::lists('deskripsi','tipe_id');
        $t = $this->faskesTipe;
       return view('faskes.edit',compact('f','t'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //old way
         $validator = Validator::make($request->all(), [
            'nama_faskes' => 'required|min:3',
            'alamat' => 'required', //or ['required|date]
            'latitude'=>'required',
            'longitude' =>'required',
            'web' => 'url',
            'phone' => 'regex:/(\(\d{4}+\)+ \d{3}+\-\d{3}+)/'
        ],[
            'nama_faskes.required'  => 'Kolom Nama Faskes tidak boleh kosong',
            'alamat.required'       => 'Alamat tidak boleh kosong',
            'latitude.required'     => 'Latitude tidak boleh kosong',
            'longitude.required'    => 'Longitude tidak boleh kosong',
            'web.url'               => 'alamat website tidak valid',
            'phone.regex'           => 'Nomor Telpon tidak valid'
        ]);

        if ($validator->fails()) {
            return redirect('faskes/' . $id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $faskesUpdate = $request->all();
        $f = Faskes::find($id);
        $f->update($faskesUpdate);
        return redirect('faskes')->with('message','Data Faskes Berhasil Di Ubah');

        //research in new way because it relation :(
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        Pegawai::find($id)->delete();
//        return redirect('pegawai')->with('message', 'Data berhasil dihapus!');

        Faskes::find($id)->delete();
        return redirect('faskes')->with('message','Data Berhasil dihapus');
    }
}
