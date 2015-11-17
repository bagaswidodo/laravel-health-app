@extends('layout.admin')

@section('content')
<h1>Ubah Jadwal Praktek </h1>

    @include('errors.list')

    {!! Form::model($p[0],['method'=>'PATCH',
        'action'=> ['PraktekDokterFaskesController@update',$p[0]->faskes_id,$p[0]->dokter_id,$p[0]->hari]]) !!}

    {!! Form::hidden('faskes_id',$p[0]->faskes_id)!!}
    {!! Form::hidden('dokter_id',$p[0]->dokter_id)!!}

    @include('faskes.dokter.praktek._form',['submitButtonText'=>'Ubah Jadwal Praktek'])


    {!! Form::close() !!}

    <div class="alert alert-warning">Jika praktek sore otomatis checked dan data masuk. disable hari when update</div>
@stop
