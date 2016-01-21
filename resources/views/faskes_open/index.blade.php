@extends('layout.admin')

@section('content')
    {{--<h1>Jadwal Praktek Dokter {{$faskes->nama_faskes}}</h1>--}}
    <h1>Jadwal Praktek Faskes <small>{{ $faskes->nama_faskes  }}</small></h1>
    <hr/>
    <?php $i = 1; ?>

    <a href="{{url('faskes/' . $faskes->faskes_id . '/open/create')}}">
        <button class="btn btn-default">Jadwal Praktek Baru</button>
    </a>

    @if($faskes->works->count())
    <table class="table table-border table-hover table-striped">
        <tr>
             <td>No</td>
             {{--<td>Nama Layanan Kesehatan</td>--}}
             <td>Hari</td>
             <td>Jadwal Praktek</td>
             <td>Aksi</td>
        </tr>
        <?php
        $hari = array(  0 => 'Senin',
                        1 => 'Selasa',
                        2 => 'Rabu',
                        3 => 'Kamis',
                        4 => 'Jumat',
                        5 => 'Sabtu',
                        6 => 'Minggu'
                      );

        ?>

        @foreach($faskes->works as $fo)
             <tr>
                         <td> {{ $i  }}</td>
                         <td>
                            <h5>{{ $hari[$fo->hari] }}</h5>
                        </td>
                         <td>
                            <?php
                            if($fo->jam_mulai_istirahat == "00:00:00")
                            {
                            ?>
                             <small>{{ $fo->jam_buka }} - {{ $fo->jam_tutup }}</small><br />
                            <?php
                            }else{
                            ?>
                             <small>{{ $fo->jam_buka }} - {{ $fo->jam_mulai_istirahat }}</small><br />
                             <small>{{ $fo->jam_selesai_istirahat }} - {{ $fo->jam_tutup }}</small>
                            <?php } ?>
                         </td>

                         <td class="pull-right">
                         <a href="{{ URL('faskes/' . $faskes->faskes_id . '/open/' .$fo->hari. '/edit') }}">
                            <button class="btn btn-success">Ubah Jadwal</button>
                         </a>

                          {!! Form::open(['url' => 'faskes/' . $faskes->faskes_id . '/open/' .$fo->hari , 'class' => 'pull-right']) !!}
                                             {!! Form::hidden('_method', 'DELETE') !!}
                                             {!! Form::submit('Hapus Data', ['class' => 'btn btn-danger']) !!}
                                         {!! Form::close() !!}
                            {{--<button class="btn btn-danger">Hapus Jadwal</button>--}}
                         </td>
                    </tr>
             <?php $i++; ?>
        @endforeach
    </table>
    @else
            <div class="alert alert-warning"> Jadwal Praktek Belum Ada</div>
    @endif
@stop

