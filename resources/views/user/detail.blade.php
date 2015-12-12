@extends('layout.user')

@section('content')
    <h1>Detail Faskes {{ $f->nama_faskes }} <smal>{{ $f->bpjs }}</smal></h1>
    {{$f->alamat}}
    <hr/>
@stop