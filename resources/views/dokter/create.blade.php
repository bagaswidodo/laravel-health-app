@extends('layout.admin')
@section('content')
     <h1>Buat Dokter Baru</h1>
     @if($errors->any())
        <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
             <li> {{ $error }}</li>
        @endforeach
        </ul>
     @endif

{!! Form::open(array('url' => 'dokter')) !!}
    <div class="form-group">
        {!! Form::label('nama', 'Nama Dokter') !!}
        {!! Form::text('nama', null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Buat Dokter Baru ', array('class' => 'btn btn-primary')) !!}

{!! Form::close() !!}
@stop