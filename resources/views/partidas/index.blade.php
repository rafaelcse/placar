@extends('adminlte::page')
@section('content_header')
<h1>Partidas</h1>
<div class="heading-elements">
	<a href="{{route('partidas.create')}}" class="btn btn_verde btn-add-cliente">
		<i class="fas fa-plus"></i>Novo</a>
	</div>
	@stop
	@section('content')

	<form  action="{{ Request::url() }}"  autocomplete="off" method="GET"> 
		<div class="row">
			<div class="col-md-6">
				<input type="text" id="range_data" class="form-control dateRange" style=""  value="">
				<input type="hidden" name="data_i" id="data_i" value="{{ \Request::input('data_i', date('Y-m-d', strtotime('-1 months', strtotime(date('Y-m-d'))))) }}">
				<input type="hidden" name="data_f" id="data_f" value="{{ \Request::input('data_f', date('Y-m-d')) }}">
			</div>
			<div class="col-md-1">
				<input type="submit" name="Atualizar" class="btn btn-primary btn-flat">
			</div>
		</div>         
	</form>


	<br><br>


	<table id="datatable-responsive" class="table table-hover table-striped table-bordered display nowrap" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Vencedor 01</th>
				<th>Vencedor 02</th>
				<th>Perdedor 01</th>
				<th>Perdedor 02</th>
				<th>Valor</th>
				<th>Data</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>


			@foreach ($partidas as $partida)
			<tr>
				<td>{{ $partida->Vencedor1->nome }}</td>
				<td>{{ $partida->Vencedor2 ? $partida->Vencedor2->nome : "" }}</td>
				<td>{{ $partida->Perdedor1->nome }}</td>
				<td>{{ $partida->Perdedor2 ? $partida->Perdedor2->nome : "" }}</td>
				<td>{{ $partida->valor_aposta }}</td>
				<td>{{ $partida->data_partida->format('d/m/Y') }}</td>
				<td>
					
					<a href= "{{route('partidas.edit',$partida->id)}}" class="btn"><i class="fa fa-edit"></i>Editar</a>
					<a onclick="return confirm(\'Tem certeza que deseja deletar?\')"  href="{{ route('partidas.delete', $partida->id)  }}" class="btn"><i class="fa fa-trash"></i>Excluir</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@stop


	@push('js')

	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

	<script>




		$jque = jQuery.noConflict();
		$jque('.dateRange').daterangepicker({
			"timePicker": false,
			"timePicker24Hour": true,
			"timePickerSeconds": true,
			"startDate": moment($jque("#data_i").val()).set({hour:0,minute:0,second:0,millisecond:0})/*.subtract(2, "M")*/,
			"endDate": moment($jque("#data_f").val()).set({hour:23,minute:59,second:59,millisecond:0}),
			"maxSpan": {
				"years": 2
			},

			locale: {

				"applyLabel": "Aplicar",
				"cancelLabel": "Cancelar",
				"fromLabel": "De",
				"toLabel": "Até",
				"customRangeLabel": "Custom",
				"daysOfWeek": [
				"Dom",
				"Seg",
				"Ter",
				"Qua",
				"Qui",
				"Sex",
				"Sáb"
				],
				"monthNames": [
				"Janeiro",
				"Fevereiro",
				"Março",
				"Abril",
				"Maio",
				"Junho",
				"Julho",
				"Agosto",
				"Setembro",
				"Outubro",
				"Novembro",
				"Dezembro"
				],

				format: 'DD/MM/YYYY'
			}
		}, function(start, end, label) {

			$jque("#data_i").val(start.format('YYYY-MM-DD'));
			$jque("#data_f").val(end.format('YYYY-MM-DD'));
		});

	</script>


	@endpush