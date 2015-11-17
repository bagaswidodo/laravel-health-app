@extends('layout.admin')

@section('content')
<h1>Buat Faskes Baru</h1>
    <hr/>

    @include('errors.list')
    {!! Form::open(['url'=>'faskes']) !!}

    @include('faskes._form',['submitButtonText'=>'Tambah Faskes'])


    {!! Form::close() !!}

    <div class="alert alert-info">
        <b>Improve</b> Map,Select 2 from API tipe,geocode lokasi,geolocation html,validation, add kolom bpjs support
    </div>

@stop


@section('footer')
foo
<link rel="stylesheet" href=" {{ asset('vendor/bootstrap-toggle/bootstrap-toggle.min.css') }}"/>
<script type="text/javascript" src=" {{ asset('vendor/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

@stop
