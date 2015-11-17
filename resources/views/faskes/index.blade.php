@extends('layout.admin')

@section('content')
    <h1>Daftar Lyanan kesehatan</h1>
    <hr/>

    <br>
    <a href="{{url('faskes/create')}}">
    <button class="btn btn-default">Tambah Faskes</button>
    </a><br >
    @if($f->count())
         <table class="table table-bordered table-hover table-striped">
            <tr>
                <td>No</td>
                <td>Nama Faskes</td>
                <td>Alamat</td>
                <td>Aksi</td>
            </tr>
            <?php $i = 1; ?>
            @foreach($f as $faskes)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $faskes->nama_faskes }}</td>
                <td>{{ $faskes->alamat  }}</td>
                <td>
                    <a class="btn btn-small btn-info" href="{{ URL::to('faskes/' . $faskes->faskes_id . '/edit') }}">
                        {{--<button class="btn btn-warning">Ubah</button>--}}
                        Ubah
                    </a>
                    {{--jika tipenya rumah sakit/klinik button jadwal praktek--}}
                    @if($faskes->tipe_id == 1 || $faskes->tipe_id == 2)
                        <a class="btn btn-small btn-warning" href="{{ URL::to('faskes/' . $faskes->faskes_id . '/dokter') }}">
                            Detail
                        </a>
                    @else
                        <a class="btn btn-small btn-warning" href="{{ URL::to('faskes/' . $faskes->faskes_id . '/open') }}">
                            Jadwal Praktek
                        </a>
                    @endif



                    {!! Form::open(['url' => 'faskes/' . $faskes->faskes_id, 'class' => 'pull-left']) !!}
                       {!! Form::hidden('_method', 'DELETE') !!}
                       {!! Form::submit('Hapus Data', ['class' => 'btn btn-danger']) !!}
                     {!! Form::close() !!}
                    {{--<button class="btn btn-danger">Hapus</button>--}}
                </td>
            </tr>
            <?php $i++; ?>
            @endforeach
         </table>
        @else
            <div class="alert alert-warning">Data Tidak ditemukan</div>
        @endif

            <div class="alert alert-info"><strong> Improe Feature : </strong>
            Pagination, Find, Id NUmber ++ template, if dokter only jadwal praktek if klinik/rs add new dokter</div>

@stop

