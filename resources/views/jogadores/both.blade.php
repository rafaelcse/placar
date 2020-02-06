@extends('adminlte::page')
@section('content_header')
@if($acao != "add")
<h1><span>Editar</span> Jogador</h1>
@else
<h1><span>Cadastrar</span> Jogador</h1>
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
        <form  action=" {{ route('jogadores.update',$dados->id) }}" method="POST" autocomplete="off">
          {!! method_field('PUT') !!} 
          @else
          <form  action="{{  route('jogadores.store') }}" method="POST" autocomplete="off">  
            @endif
            <div class="row">
              {!! csrf_field() !!}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nome">Nome </label>
                  <input type="text" placeholder="Nome Jogador" class="form-control" name="nome" id="nome" value="{{ old('nome') ? old('nome') : $dados->nome}}" required>
                  
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
