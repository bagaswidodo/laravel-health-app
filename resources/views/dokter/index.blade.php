@extends('layout.admin')

@section('content')
    <h1>Daftar Dokter <small>Nama Faskes</small></h1>
    <hr/>

    <a href="{{ url('dokter/create') }}">
    <button class="btn btn-default">Dokter Baru</button>
    </a>

    @if($d->count())
         <table class="table table-border table-hover table-striped">
            <tr>
                <td>No</td>
                <td>Nama </td>
                <td>Aksi</td>
            </tr>
            <?php echo $i = 1; ?>
            @foreach($d as $dokter)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $dokter->nama }}</td>
                <td>
                    <button class="btn btn-success">
                    Jadwal Praktek
                    </button>
                    <button class="btn btn-warning">
                    Ubah
                    </button>
                    <button class="btn btn-danger">
                    Hapus
                    </button>
                    {{--<a class="btn btn-small btn-info" href="{{ URL::to('api/faskes/' . $faskes->faskes_id . '/edit') }}">--}}
                        {{--<button class="btn btn-warning">Ubah</button>--}}
                        {{--Ubah--}}
                    {{--</a>--}}

                    {{--{!! Form::open(['url' => 'api/faskes/' . $faskes->faskes_id, 'class' => 'pull-right']) !!}--}}
                       {{--{!! Form::hidden('_method', 'DELETE') !!}--}}
                       {{--{!! Form::submit('Hapus Data', ['class' => 'btn btn-danger']) !!}--}}
                     {{--{!! Form::close() !!}--}}
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
            Pagination, Find,  template, breadcrumb</div>

@endsection