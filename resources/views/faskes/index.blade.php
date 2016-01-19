@extends('layout.admin')

@section('content')
    <h1>Daftar Lyanan kesehatan</h1>
    <hr/>
    <div class="alert alert-warning">Pagination</div>

    <br>
    <a href="{{url('faskes/create')}}">
    <button class="btn btn-default"><i class="glyphicon glyphicon-cog"></i>Tambah Faskes</button>

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
                        <i class="glyphicon glyphicon-pencil"></i>
                    </a>
                    {{--jika tipenya rumah sakit/klinik button jadwal praktek--}}
                    @if($faskes->tipe_id == 1 || $faskes->tipe_id == 2)
                                            <a href="{{ URL::to('faskes/' . $faskes->faskes_id . '/dokter') }}" title="Daftar Dokter">
                                                <button class="btn btn-success"><i class="glyphicon glyphicon-user"></i></button>
                                            </a>

                                        @endif
                                        <a class="btn btn-small btn-warning" href="{{ URL::to('faskes/' . $faskes->faskes_id . '/open') }}">
                                              <i class="glyphicon glyphicon-calendar"></i>
                                        </a>
                    {!! Form::open(['url' => 'faskes/' . $faskes->faskes_id, 'class' => 'pull-left']) !!}
                       {!! Form::hidden('_method', 'DELETE') !!}
                       <?php $text = "<i>Foo Bar</i>"; ?>
                       {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                       {{--{!! Form::submit('<b>foo</b>', ['class' => 'btn btn-danger']) !!}--}}
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

