<?php

namespace App\Http\Controllers;

use Validator;
use App\Dokter;
use App\Faskes;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FaskesDokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $faskes = Faskes::findOrFail($id);
        $d = Dokter::lists('nama','dokter_id');
        $dokter =  $faskes->dokter->toArray();

        return view('faskes.dokter.index',compact('faskes','d','dokter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $f = Faskes::findOrFail($id);
        return view('faskes.dokter.create',compact('f','d'));
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
            'nama' => 'required|min:3'
        ],[
            'nama.required'  => 'Kolom Nama tidak boleh kosong',
            'nama.min' => 'Panjang nama minimal 3 karakter'
        ]);

        if ($validator->fails()) {
            return redirect('faskes/'.$request->faskes_id.'/dokter/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        Dokter::create($request->all());
        return redirect('faskes/'.$request->faskes_id.'/dokter')->with('message','Dokter Berhasil ditambahkan');
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
    public function edit($faskes, $id)
    {

        $dokter = Dokter::findOrFail($id);
//        dd($dokter->toArray());
        return view('faskes.dokter.edit',compact('dokter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $faskes, $id)
    {

        $ubahDokter = $request->all();
        $dokter = Dokter::findOrFail($id);
        $dokter->update($ubahDokter);
        return redirect('faskes/'.$request->faskes_id.'/dokter')->with('message','Dokter Berhasil ditambahkan');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($faskes, $id)
    {
        //
        Dokter::findOrFail($id)->delete();
        return redirect('faskes/'.$faskes.'/dokter')->with('message','Dokter Berhasil ditambahkan');

    }
}
