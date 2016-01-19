@extends('layout.admin')

@section('content')
<h1>Ubah Data Faskes <small>{{ $f->nama_faskes }}</small> </h1>
    <hr/>
    @include('errors.list')
 {!! Form::model($f,['method'=>'PATCH', 'action'=> ['FaskesController@update',$f->faskes_id]]) !!}

       @include('faskes._edit',['submitButtonText'=>'Update Faskes'])

       {!! Form::close() !!}



@stop