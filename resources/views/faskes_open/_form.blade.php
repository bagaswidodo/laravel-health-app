    <hr/>
    @include('errors.list')
            <?php
                $day = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];

             ?>

            {{--input hari dan jam praktek--}}
             <div class="form-group">
                {!! Form::label('hari','Hari Kerja') !!}
                {!! Form::select('hari', $day,null,['class' => 'form-control']) !!}
             </div>


             <div class="form-group">
                 <div class="row">
                   <div class="col-xs-6">
                  {!! Form::text('jam_buka',null,['class'=>'form-control','id'=>'jam_buka']) !!}
                     {{--<input type="text" placeholder="Jam Buka" class="form-control" placeholder=""--}}
                     {{--name="jam_buka" id="jam_buka" >--}}
                   </div>
                   <div class="col-xs-6">
                     {!! Form::text('jam_tutup',null,['class'=>'form-control','id'=>'jam_tutup']) !!}
                     {{--<input type="text" placeholder="Jam Tutup" class="form-control" placeholder=".col-xs-3"--}}
                     {{--name="jam_tutup" id="jam_tutup" >--}}
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
                     {{--<input type="text" placeholder="Jam Buka" class="form-control" placeholder=""--}}
                     {{--name="jam_mulai_istirahat" id="jam_mulai_istirahat"  disabled>--}}
                   </div>
                   <div class="col-xs-6">
                    {!! Form::text('jam_selesai_istirahat',null,['class'=>'form-control','id'=>'jam_selesai_istirahat','disabled']) !!}
                     {{--<input type="text" placeholder="Jam Tutup" class="form-control" placeholder=".col-xs-3"--}}
                     {{--name="jam_selesai_istirahat" id="jam_selesai_istirahat"  disabled>--}}
                   </div>
                 </div>
              </div>



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