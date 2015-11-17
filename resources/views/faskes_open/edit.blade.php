@extends('layout.admin')

@section('content')
<h1>Ubah Jadwal Praktek </h1>

    @include('errors.list')
    {!! Form::model($faskes[0],['method'=>'PATCH', 'action'=> ['FaskesOpenController@update',$faskes[0]->faskes_id,$faskes[0]->hari]]) !!}

    {{--{!! Form::open(['url'=>'faskes/'. $faskes[0]->faskes_id .'/open']) !!}--}}
    {!! Form::hidden('faskes_id',$faskes[0]->faskes_id)!!}

    @include('faskes_open._form',['submitButtonText'=>'Ubah Jadwal Praktek'])


    {!! Form::close() !!}

    <div class="alert alert-warning">Jika praktek sore otomatis checked dan data masuk. disable hari when update</div>
@stop
