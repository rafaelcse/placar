@extends('adminlte::page')
@section('content_header')
<h1>Patinetes</h1>
<div class="heading-elements">
	<a href="{{route('jogadores.create')}}" class="btn btn_verde btn-add-cliente">
		<i class="fas fa-plus"></i>Novo</a>
	</div>
	@stop
	@section('content')

	<table id="datatable-responsive" class="table table-hover table-striped table-bordered display nowrap" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Nome</th>
				<th>Ação</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($jogadores as $jogador)
			<tr>
				<td>{{ $jogador->nome }}</td>
				<td></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@stop
