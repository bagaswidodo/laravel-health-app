@extends('layout.admin')

@section('content')
<h1>Buat Faskes Baru</h1>
    <hr/>

    @include('errors.list')
    {!! Form::open(['url'=>'faskes']) !!}

    @include('faskes._form',['submitButtonText'=>'Tambah Faskes'])


    {!! Form::close() !!}

   

@stop


@section('footer')
foo
<link rel="stylesheet" href=" {{ asset('vendor/bootstrap-toggle/bootstrap-toggle.min.css') }}"/>
<script type="text/javascript" src=" {{ asset('vendor/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

@stop
