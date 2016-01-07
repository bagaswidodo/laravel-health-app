@extends('layout.admin')

@section('content')
<h1>Ubah Data Faskes <small>{{ $f->nama_faskes }}</small> </h1>
    <hr/>
    @include('errors.list')
 {!! Form::model($f,['method'=>'PATCH', 'action'=> ['FaskesController@update',$f->faskes_id]]) !!}

       @include('faskes._edit',['submitButtonText'=>'Update Faskes'])

       {!! Form::close() !!}
    <div class="alert alert-info">
        <b>Improve</b> Map,Select 2 from API tipe,geocode lokasi,geolocation html,validation, add kolom bpjs support
    </div>


@stop