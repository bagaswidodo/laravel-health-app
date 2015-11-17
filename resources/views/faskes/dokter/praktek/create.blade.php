@extends('layout.admin')

@section('content')
    <h1>Create jadwal praktek dokter <small>{{ $dokter->nama }}</small></h1>

      @include('errors.list')
        {!! Form::open(['url'=>'faskes/'. $dokter->faskes_id .'/dokter/'. $dokter->dokter_id . '/praktek']) !!}
        {!! Form::hidden('faskes_id',$dokter->faskes_id)!!}
        {!! Form::hidden('dokter_id',$dokter->dokter_id)!!}

        @include('faskes.dokter.praktek._form',['submitButtonText'=>'Tambah Jadwal Praktek'])


        {!! Form::close() !!}
@stop