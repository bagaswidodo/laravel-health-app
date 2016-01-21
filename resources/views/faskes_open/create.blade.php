@extends('layout.admin')

@section('content')
<h1>Tambahkan Jadwal Praktek <small>{{  $faskes->nama_faskes }}</small></h1>

    @include('errors.list')

    @if(Session::has('message'))
		<div class="alert alert-warning">{{ session('message') }}</div>
	@endif
    {!! Form::open(['url'=>'faskes/'. $faskes->faskes_id .'/open']) !!}
    {!! Form::hidden('faskes_id',$faskes->faskes_id)!!}

    @include('faskes_open._form',['submitButtonText'=>'Tambah Jadwal Praktek'])


    {!! Form::close() !!}
@stop
