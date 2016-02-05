@extends('layout.admin')

@section('content')
    <h1>{{ $faskes->nama_faskes }}</h1>
    <h5>Alamat : {{ $faskes->alamat }}</h5>

        <h3>Daftar Dokter</h3>
        <a href="{{ URL::to('faskes/' . $faskes->faskes_id . '/dokter/create') }}">
        <button class="btn btn-default">Tambah Dokter</button>
        </a>


    @if($faskes->dokter->count() > 0)
    <table class="table table-border table-hover table-stripe">
        <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Aksi</td>
        </tr>
        <?php $i = 1;
        // var_dump($faskes->dokter);
         ?>
        @foreach($faskes->dokter as $dokter)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $dokter->nama }}</td>
            <td>
                <a href="{{ URL('faskes/' . $faskes->faskes_id . '/dokter/' .$dokter->dokter_id. '/praktek/') }}">
                    <button class="btn btn-success"><i class="glyphicon glyphicon-calendar"></i></button>
                </a>
                <a href="{{ URL('faskes/' . $faskes->faskes_id . '/dokter/' .$dokter->dokter_id. '/edit') }}">
                    <button class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></button>
                </a>

                 {!! Form::open(['url' => 'faskes/' . $faskes->faskes_id . '/dokter/' .$dokter->dokter_id , 'class' => 'pull-right']) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                         {!! Form::submit('Hapus Data', ['class' => 'btn btn-danger']) !!}
                 {!! Form::close() !!}
                {{--<button class="btn btn-danger">Hapus</button>--}}
                <!-- <div class="alert alert-warning">Cek Konflik Jadwal </div> -->
            </td>
        </tr>
        <?php $i++; ?>
         @endforeach
    </table>
    @else
       <div class="alert alert-warning">
        Belum Ditemukan daftar dokter
       </div>
    @endif

    <!-- <div class="alert alert-info"><strong>Imrpove : </strong> Pagination, </div> -->
@endsection


@section('footer')
<link rel="stylesheet" href=" {{ asset('vendor/select2/css/select2.min.css') }}"/>
<script type="text/javascript" src=" {{ asset('vendor/select2/css/select2.min.js') }}"></script>

<script>
$('#dokter_list').select2();
</script>

@stop