@extends('layout.admin')

@section('content')
<h1>Buat Tipe Baru</h1>

 @if($errors->any())
     <ul class="alert alert-danger">
         @foreach($errors->all() as $error)
             <li> {{ $error }}</li>
          @endforeach
     </ul>
@endif

{!! Form::open(array('url' => 'api/tipe')) !!}
    <div class="form-group">
        {!! Form::label('deskripsi', 'Deskripsi') !!}
        {!! Form::text('deskripsi', null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Buat Tipe Baru !', array('class' => 'btn btn-primary')) !!}

{!! Form::close() !!}
@stop