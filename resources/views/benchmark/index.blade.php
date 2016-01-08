@extends('layout.user')

@section('content')
<div class="container">
	<div class="col-md-6">
		Haversine
		Waktu eksekusi {{ $haversine['time_elapsed']}}
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
				<td>{{ $v->jarak }}</td>
			</tr>
			<?php $no++; ?>
			@endforeach
		</table>
	</div>
	<div class="col-md-6">
		Euclidean
		Waktu eksekusi {{ $euclidean['time_elapsed']}}
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
				<td>{{ $v->jarak }}</td>
			</tr>
			<?php $no++; ?>
			@endforeach
		</table>
	</div>
</div>

@stop
