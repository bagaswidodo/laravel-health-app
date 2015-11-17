@extends('layout.admin')

@section('content')
    <h1>Jadwal Praktek Dokter <small>{{ $jadwal->nama }}</small></h1>

    <a href="{{url('faskes/' . $jadwal->faskes_id . '/dokter/'.$jadwal->dokter_id .'/praktek/create')}}">
     <button class="btn btn-default">Tambahkan Jadwal Praktek</button><br/><br/>
    </a>

    @if($jadwal->praktek->count())
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <td>No</td>
            <td>Jadwal Praktek</td>
            <td>Aksi</td>
        </tr>
        <?php $i = 1; ?>
        @foreach($jadwal->praktek as $praktek)
        <tr>
            <td>{{ $i }}</td>
            <td>
                <strong>{{ $d[$praktek->hari] }}</strong><br/>
                <small>{{ $praktek->jam_mulai }} - {{$praktek->jam_selesai}}</small>
            </td>
            <td>
             <a href="{{ URL('faskes/' . $jadwal->faskes_id . '/dokter/' .$jadwal->dokter_id . '/praktek/' . $praktek->hari . '/edit') }}">
                 <button class="btn btn-default pull-right">Ubah</button>
             </a>


                  {!! Form::open(['url' => 'faskes/' . $jadwal->faskes_id . '/dokter/' .$jadwal->dokter_id
                  . '/praktek/' . $praktek->hari, 'class' => 'pull-right']) !!}
                       {!! Form::hidden('_method', 'DELETE') !!}
                       {!! Form::submit('Hapus Data', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
            </td>
        </tr>
        <?php $i++; ?>
        @endforeach
    </table>
    @else
        <div class="alert alert-warning">Jadwal Praktek belum ada</div>
    @endif

    <div class="alert alert-warning">Cek konflik jadwal, cek hari, disable hari when update</div>
@stop