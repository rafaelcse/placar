@extends('adminlte::page')
@section('content_header')
@if($acao != "add")
<h1><span>Editar</span> Partida</h1>
@else
<h1><span>Cadastrar</span> Partida</h1>
@endif
@stop
@section('content')
<div class="">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-body">
         @if ($errors->any())
         <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        @if($acao != 'add')
        <form  action=" {{ route('partidas.update',$dados->id) }}" method="POST" autocomplete="off">
          {!! method_field('PUT') !!} 
          @else
          <form  action="{{  route('partidas.store') }}" method="POST" autocomplete="off">  
            @endif
            <div class="row">
              {!! csrf_field() !!}
              


              <div class="col-md-6">
                <div class="form-group">
                  <label for="vencedor1_id">Vencedor 01* </label>

                  <select class="form-control" name="vencedor1_id" id="vencedor1_id" placeholder="" required>
                    <option value="">Selecione</option>  
                    @foreach($jogadores as $jogador)                    
                    <option value="{{$jogador->id}}" {{ (old('vencedor1_id') ? old('vencedor1_id') : $dados->vencedor1_id ) == $jogador->id ? 'selected' : '' }} >{{$jogador->nome}}</option>
                    @endforeach
                  </select>

                  
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="vencedor2_id">Vencedor 02 </label>

                  <select class="form-control" name="vencedor2_id" id="vencedor2_id" placeholder="" >
                    <option value="">Selecione</option>  
                    @foreach($jogadores as $jogador)                    
                    <option value="{{$jogador->id}}" {{ (old('vencedor2_id') ? old('vencedor2_id') : $dados->vencedor2_id ) == $jogador->id ? 'selected' : '' }} >{{$jogador->nome}}</option>
                    @endforeach
                  </select>

                  
                </div>
              </div>


              <div class="col-md-6">
                <div class="form-group">
                  <label for="perdedor1_id">Perdedor 01* </label>

                  <select class="form-control" name="perdedor1_id" id="perdedor1_id" placeholder="" required>
                    <option value="">Selecione</option>  
                    @foreach($jogadores as $jogador)                    
                    <option value="{{$jogador->id}}" {{ (old('perdedor1_id') ? old('perdedor1_id') : $dados->perdedor1_id ) == $jogador->id ? 'selected' : '' }} >{{$jogador->nome}}</option>
                    @endforeach
                  </select>

                  
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="perdedor2_id">Perdedor 02 </label>
                  <select class="form-control" name="perdedor2_id" id="perdedor2_id" placeholder="" >
                    <option value="">Selecione</option>  
                    @foreach($jogadores as $jogador)                    
                    <option value="{{$jogador->id}}" {{ (old('perdedor2_id') ? old('perdedor2_id') : $dados->perdedor2_id ) == $jogador->id ? 'selected' : '' }} >{{$jogador->nome}}</option>
                    @endforeach
                  </select>
                </div>
              </div>


              <div class="col-md-6">
                <div class="form-group">
                  <label for="valor_aposta">Valor Aposta* </label>
                  <input type="number" placeholder="Valor Aposta" class="form-control" name="valor_aposta" id="valor_aposta" value="{{ old('valor_aposta') ? old('valor_aposta') : $dados->valor_aposta}}" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="data_partida">Data partida* </label>
                  <input type="date" placeholder="data_partida" class="form-control" name="data_partida" id="data_partida" value="{{ old('data_partida') ? old('data_partida') : ($dados->data_partida ? $dados->data_partida->format('Y-m-d'): "") }}" required>
                </div>
              </div>




              <div class="col-md-12">
                <center>
                  <hr>
                  <button type="submit" class="btn btn_verde btn-primary"><i class="far fa-check-circle"></i>Enviar</button>
                </center>
              </div>
            </div>
          </form>
          @endsection
