@extends('layout.admin')

@section('content')
<h1>Ubah  Dokter Faskes  </h1>
    <hr/>
    @include('errors.list')

    {!! Form::model($dokter,['method'=>'PATCH',
    'action'=> ['FaskesDokterController@update',$dokter->faskes_id,$dokter->dokter_id]]) !!}

    @include('faskes.dokter._form',['submitButtonText'=>'Ubah Data dokter Faskes'])
    {!! Form::hidden('faskes_id',$dokter->faskes_id) !!}
    {!! Form::close() !!}

    <div class="alert alert-info">
        <b>Improve</b> Map,Select 2 from API tipe,geocode lokasi,geolocation html,validation, add kolom bpjs support
    </div>

@stop


@section('footer')

<link rel="stylesheet" href=" {{ asset('vendor/bootstrap-toggle/bootstrap-toggle.min.css') }}"/>
<script type="text/javascript" src=" {{ asset('vendor/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

@stop
