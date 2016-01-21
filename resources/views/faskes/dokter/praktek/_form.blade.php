    <hr/>
    @include('errors.list')
            <?php
                $day = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];

             ?>

            {{--input hari dan jam praktek--}}
             <div class="form-group">
                {!! Form::label('hari','Hari Kerja') !!}
                {!! Form::select('hari', $day,null,['class' => 'form-control',(isset($p[0]->hari)) ? 'disabled' : '']) !!}
             </div>


             <div class="form-group">
                 <div class="row">
                   <div class="col-xs-6">
                      {!! Form::text('jam_mulai',null,['class'=>'form-control','id'=>'jam_buka']) !!}
                   </div>
                   <div class="col-xs-6">
                     {!! Form::text('jam_selesai',null,['class'=>'form-control','id'=>'jam_tutup']) !!}
                    </div>
                 </div>
              </div>
             {{--end input jam hari dan praktek--}}
             {{--bug : jika ada value praktek sore otomatis checked --}}
           <div class="form-group">
               {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
               {!! Form::submit('Batal', ['class' => 'btn btn-danger form-control']) !!}
           </div>
    <div class="alert alert-info">
        <b>Improve</b> Time picker, Time validation,
    </div>


@section('footer')
<link rel="stylesheet" href="{{ asset('vendor/jquery-timepicker/jquery.timepicker.css') }}"/>
<script src="{{ asset('vendor/jquery-timepicker/jquery.timepicker.min.js') }}"></script>
<script>
    $('#jam_buka').timepicker({
       'minTime': '5:00am',
       'maxTime': '11:30pm',
        'timeFormat': 'H:i',
        'showDuration': true
      }).on('selectTime', function(){
        $('#jam_tutup').timepicker({
          'minTime': $('#jam_buka').val(),
          'maxTime': '11:30pm',
          'timeFormat': 'H:i',
          'showDuration': true
        }).on('selectTime', function(){
        });
     });



</script>
@stop