        <div class="alert alert-info">
        <strong>Improvement ! </strong>Validation, custom validation callback. ajax validation better !
        </div>
    {!! Form::hidden('faskes_id',Auth::user()->user_id) !!}

    <div class="form-group">
        {!! Form::label('nama_dokter', 'Nama Dokter : ') !!}
        {!! Form::text('nama',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
            {!! Form::label('nomor_telpon', 'Nomor Telpon : ') !!}
            {!! Form::text('nomor_telpon',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
                {!! Form::label('alamat', 'Alamat : ') !!}
                {!! Form::textarea('alamat',null,['class'=>'form-control']) !!}
            </div>

    <div class="form-group">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
    </div>



@section('footer')
    <script>
    $('#tag_list').select2({
        placeholder:'Choose a tag',
        tags:true //for auto add
    });
    </script>
@endsection
