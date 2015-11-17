@extends('layout.admin')

@section('content')
    <h1>Daftar tipe</h1>

    <!-- digunakan untuk menampilkan pesan -->
    @if (Session::has('message'))
        <div class="alert alert-info" style="margin:10px 0 10px 0;">{{ Session::get('message') }}</div>
    @endif


    <a href="{{ URL('api/tipe/create') }}">
    <button class="btn btn-default">Tambah Tipe</button>
    </a>
    @if($allTipe->count())
     <table class="table table-border table-hover table-striped">
        <tr>
            <td>no</td>
            <td>Deskripsi</td>
            <td>Aksi</td>
        </tr>
        @foreach($allTipe as $tipe)
        <tr>
            <td>{{ $tipe->tipe_id }}</td>
            <td>{{ $tipe->deskripsi }}</td>
            <td>
                <a class="btn btn-small btn-info" href="{{ URL::to('api/tipe/' . $tipe->tipe_id . '/edit') }}">
                    {{--<button class="btn btn-warning">Ubah</button>--}}
                    Ubah
                </a>

                {!! Form::open(['url' => 'api/tipe/' . $tipe->tipe_id, 'class' => 'pull-right']) !!}
                   {!! Form::hidden('_method', 'DELETE') !!}
                   {!! Form::submit('Hapus Data', ['class' => 'btn btn-danger']) !!}
                 {!! Form::close() !!}
                {{--<button class="btn btn-danger">Hapus</button>--}}
            </td>
        </tr>
        @endforeach
     </table>
    @else
        <div class="alert alert-warning">Data Tidak ditemukan</div>
    @endif

    <div class="alert alert-info"><strong> Improe Feature : </strong>
    Pagination, Find, Id NUmber ++ template</div>


@endsection