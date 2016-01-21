    <hr/>
            <?php
                $day = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
             ?>

            @if(Session::has('message'))
              <div class="alert alert-warning">{{ session('message') }}</div>
            @endif
            {{--input hari dan jam praktek--}}
            @if((isset($p[0]->hari)))
              <h3>Jadwal Dokter Hari : {{ $day[$p[0]->hari] }}</h3>
            @else
               <div class="form-group">
                  {!! Form::label('hari','Hari Kerja') !!}
                  {!! Form::select('hari', $day,null,['class' => 'form-control']) !!}
               </div>
            @endif


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
           <div class="form-group">
               {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
               <a href="{{ url($url) }}">
               <button class="btn btn-danger form-control" type="button">Batal</button>
               </a>
           </div>
    <div class="alert alert-info">
        <b>Improve</b>switch when there data not disabel input
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