  <div class="alert alert-info">
        <strong>Improvement ! </strong>Custom Validation, auto value kolom lat lng
        </div>


    <div class="row">
        {{--leftsection--}}
        <div class="col-md-10">
            {{--namaFaskes--}}
            <div class="form-group">
                    {!! Form::label('nama', 'Nama : ') !!}
                    {!! Form::text('nama',null,['class'=>'form-control']) !!}
            </div>
             <div class="form-group">
                                {!! Form::label('foto', 'Foto : ') !!}
                                {!! Form::file('foto',null,['class'=>'form-control']) !!}
             </div>
        </div>
        <div class="form-group">
                {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
                {!! Form::submit('Batal', ['class' => 'btn btn-danger form-control']) !!}
        </div>


     </div>