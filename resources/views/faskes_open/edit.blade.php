@extends('layout.admin')

@section('content')
<h1>Ubah Jadwal Praktek </h1>

    @include('errors.list')

    {{ $faskes }}

    {!! Form::open(['url'=>'faskes/'. $faskes[0]->faskes_id .'/open']) !!}
    {!! Form::hidden('faskes_id',$faskes[0]->faskes_id)!!}

    @include('faskes_open._form',['submitButtonText'=>'Ubah Jadwal Praktek'])


    {!! Form::close() !!}
@stop
