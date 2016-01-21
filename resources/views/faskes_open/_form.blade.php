            <?php
                $day = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];

             ?>

            {{--input hari dan jam praktek--}}
            @if((isset($faskes[0]->hari)))
              <h3>Jadwal Dokter Hari : {{ $day[$faskes[0]->hari] }}</h3>
            @else
               <div class="form-group">
                  {!! Form::label('hari','Hari Kerja') !!}
                  {!! Form::select('hari', $day,null,['class' => 'form-control']) !!}
               </div>
            @endif


             <div class="form-group">
                 <div class="row">
                   <div class="col-xs-6">
                  {!! Form::text('jam_buka',null,['class'=>'form-control','id'=>'jam_buka', 'placeholder'=> 'Jam Mulai']) !!}

                   </div>
                   <div class="col-xs-6">
                     {!! Form::text('jam_tutup',null,['class'=>'form-control','id'=>'jam_tutup', 'placeholder'=> 'Jam Selesai']) !!}
                   </div>
                 </div>
              </div>
             {{--end input jam hari dan praktek--}}
             {{--bug : jika ada value praktek sore otomatis checked --}}
            <div class="checkbox">
                <input type="checkbox" data-toggle="toggle" data-on="Praktek" data-off="Tidak Praktek"
                                   data-onstyle="info" data-offstyle="default" id="toggle-praktek">
                                   <label>Praktek Sore</label>
              </div>
             <div class="form-group">
                 <div class="row">
                   <div class="col-xs-6">
                    {!! Form::text('jam_mulai_istirahat',null,['class'=>'form-control','id'=>'jam_mulai_istirahat','disabled']) !!}
                   </div>
                   <div class="col-xs-6">
                    {!! Form::text('jam_selesai_istirahat',null,['class'=>'form-control','id'=>'jam_selesai_istirahat','disabled']) !!}
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
    $('#toggle-praktek').change(function() {
        //  $('#console-event').html('Toggle: ' + $(this).prop('checked'))
        var c = $(this).prop('checked');

        if(c == true)
        {
            $( "#jam_mulai_istirahat" ).prop( "disabled", false );
            $( "#jam_selesai_istirahat" ).prop( "disabled", false );
        }
        else {
             $("#jam_mulai_istirahat" ).prop( "disabled", true );
             $("#jam_selesai_istirahat" ).prop( "disabled", true );
        }

    });

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

      $('#jam_mulai_istirahat').timepicker({
            'minTime': '5:00am',
            'maxTime': '11:30pm',
             'timeFormat': 'H:i',
             'showDuration': true
           }).on('selectTime', function(){
             $('#jam_selesai_istirahat').timepicker({
               'minTime': $('#jam_mulai_istirahat').val(),
               'maxTime': '11:30pm',
               'timeFormat': 'H:i',
               'showDuration': true
             }).on('selectTime', function(){
             });
          });

</script>
@stop