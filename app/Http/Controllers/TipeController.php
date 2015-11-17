<?php

namespace App\Http\Controllers;

use App\Tipe;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allTipe = Tipe::all();
        return view('tipe.index',compact('allTipe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tipe.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['deskripsi'=>'required']);
        Tipe::create($request->all());
        return redirect('api/tipe')->with('message','Data berhasil di tambahkan');
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
        //
        $t = Tipe::findOrFail($id);

        return view('tipe.edit',compact('t'));
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
        $tipeUpdate = $request->all();
        $t = Tipe::findOrFail($id);
        $t->update($tipeUpdate);
        return redirect('api/tipe')->with('message','Data Tipe Berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Tipe::findOrFail($id)->delete();
        return redirect('api/tipe')->with('message','Data Berhasil dihapus');
    }
}
