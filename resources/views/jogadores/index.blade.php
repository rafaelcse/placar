@extends('adminlte::page')
@section('content_header')
<h1>Jogadores</h1>
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
				<td><a href= "{{route('jogadores.edit',$jogador->id)}}" class="btn"><i class="fa fa-edit"></i>Editar</a>

					<a href= "{{route('jogadores.historico',$jogador->id)}}" class="btn"><i class="fas fa-fw fa-chess-pawn"></i>Partidas</a>
            <!-- <a onclick="return confirm(\'Tem certeza que deseja deletar?\')"  href="{{ route('jogadores.delete',$jogador->id)  }}" class="btn"><i class="fa fa-trash"></i>Excluir</a> --></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@stop
