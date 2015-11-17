    <hr/>
    @include('errors.list')
            <?php
                $day = ['senin','selasa','rabu','kamis','jumat','sabtu'];

             ?>
            @foreach($day as $d)
            {{--input hari dan jam praktek--}}
             <div class="form-group">
                <label for="hari">{{ $d }}</label>
                 <input type="checkbox" data-toggle="toggle" data-on="Praktek" data-off="Tidak Praktek"
                        data-onstyle="info" data-offstyle="default" id="toggle-{{$d}}" name="{{$d}}[]">
             </div>

             <div class="form-group">
                 <div class="row">
                   <div class="col-xs-6">
                     <input type="text" placeholder="Jam Buka" class="form-control" placeholder=".col-xs-2"
                     name="{{ $d }}[]" id="{{ $d }}_buka" value="05:00" disabled>
                   </div>
                   <div class="col-xs-6">
                     <input type="text" placeholder="Jam Tutup" class="form-control" placeholder=".col-xs-3"
                     name="{{ $d }}[]" id="{{ $d }}_tutup" value="08:00" disabled>
                   </div>
                 </div>
              </div>
             {{--end input jam hari dan praktek--}}

            @endforeach


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

function form_jadwal(id)
{
    $('#toggle-'  + id).change(function() {
        //  $('#console-event').html('Toggle: ' + $(this).prop('checked'))
        var c = $(this).prop('checked');

        if(c == true)
        {
            $( "#" + id + "_buka" ).prop( "disabled", false );
            $( "#" + id + "_tutup" ).prop( "disabled", false );
        }
        else {
             $("#" + id + "_buka" ).prop( "disabled", true );
             $("#" + id + "_tutup" ).prop( "disabled", true );
        }

    });

    $('#' + id + '_buka').timepicker({
       'minTime': '5:00am',
       'maxTime': '11:30pm',
        'timeFormat': 'H:i',
        'showDuration': true
      }).on('selectTime', function(){
        $('#' + id + '_tutup').timepicker({
          'minTime': $('#jam_buka').val(),
          'maxTime': '11:30pm',
          'timeFormat': 'H:i',
          'showDuration': true
        }).on('selectTime', function(){
        });
     });

}
//form_jadwal('senin');
</script>
@foreach($day as $d)
             <script>
            form_jadwal('{{$d}}');
             </script>
             @endforeach
@stop