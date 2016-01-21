@extends('layout.admin')

@section('content')
<h1>Tambahkan  Dokter Faskes {{ $f->nama_faskes }} </h1>
    <hr/>
    @include('errors.list')
    {!! Form::open(['url'=>'faskes/'.$f->faskes_id.'/dokter']) !!}
        {!! Form::hidden('faskes_id',$f->faskes_id) !!}
    @include('faskes.dokter._form',['submitButtonText'=>'Tambah Dokter Faskes'])
    {!! Form::close() !!}
@stop

@section('footer')

<link rel="stylesheet" href=" {{ asset('vendor/bootstrap-toggle/bootstrap-toggle.min.css') }}"/>
<script type="text/javascript" src=" {{ asset('vendor/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

@stop
