@extends('layout.user')

@section('content')
    <h1>Nearby Home <small>({{ $location }})</small></h1>
    <?php //dd ($nearby); ?>
    @foreach($nearby as $n)
			        <!-- info box -->
			        <div class="list-group">
				        <a href="{{url('nearby/detail/3') }}" class="list-group-item">
				        	<h4 class="list-group-item-heading">{{ $n->nama_faskes }}</h4>
				        	{{--<small>{{$n->jam_buka}}  - {{$n->jam_istirahat}}</small>--}}
				        	<span class="pull-right">{{ $n->jarak }} KM</span>
				        	<p class="list-group-item-text">{{ $n->alamat }}</p>
				        </a>
			        </div>

    @endforeach
@stop