@extends('layout.admin')

@section('content')
@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

{!! Form::model($t, ['route' => ['api.tipe.update', $t->tipe_id], 'method' => 'PUT']) !!}

    <div class="form-group">
        {!! Form::label('deskripsi', 'Deskripsi') !!}
        {!! Form::text('deskripsi', null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Edit Data', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
@endsection