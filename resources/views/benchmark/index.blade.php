@extends('layout.user')

@section('content')
<div class="container">
	<div class="col-md-6">
		Haversine
		Waktu eksekusi {{ number_format($haversine['time_elapsed'],5,'.','') }}
		<p>Memory Usage {{ $haversine['memory_usage'] }}</p>
		<table class="table table-bordered table-striped">
			<tr>
				<td>No</td>
				<td>Nama faskes</td>
				<td>Jarak</td>
			</tr>
			<?php $no = 1; ?>
			@foreach($haversine['data'] as $v)
			<tr>
				<td>{{ $no }}</td>
				<td>{{ $v->nama_faskes }}</td>
				<td>{{ number_format($v->jarak,5,'.','') }}</td>
			</tr>
			<?php $no++; ?>
			@endforeach
		</table>
	</div>
	<div class="col-md-6">
		Euclidean
		Waktu eksekusi {{ number_format($euclidean['time_elapsed'],5,'.','') }}
		<p>Memory Usage {{ $euclidean['memory_usage'] }}</p>

		<table class="table table-bordered table-striped">
			<tr>
				<td>No</td>
				<td>Nama faskes</td>
				<td>Jarak</td>
			</tr>
			<?php $no = 1; ?>
			@foreach($euclidean['data'] as $v)
			<tr>
				<td>{{ $no }}</td>
				<td>{{ $v->nama_faskes }}</td>
				<td>{{ number_format($v->jarak,5,'.','') }}</td>
			</tr>
			<?php $no++; ?>
			@endforeach
		</table>
	</div>
</div>

@stop
