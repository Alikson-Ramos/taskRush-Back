@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@if(Session::has('msgSuccess'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fa-regular fa-bell" style="margin-right: 5px"></i> {!! Session::get('msgSuccess') !!}
        </div>
    @elseif(Session::has('msgError'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fa-solid fa-triangle-exclamation"></i> {{ Session::get('msgError') }}
        </div>
    @endif

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Início</a></li>
                    <li class="breadcrumb-item active">Tarefas</li>
                    <li class="breadcrumb-item active">Incluir Tarefa</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Nova Tarefa</div>
                    <div class="card-body">
                        <form action="{{ route('tarefas.store') }}" method="POST">
                            @csrf
                            <input type="text" class="form-control" id="user_id" name="user_id" hidden value="{{ Auth::user()->id }}">
                            <div class="form-group">
                                <label for="nome_tarefa">Nome da Tarefa</label>
                                <input type="text" class="form-control" id="nome_tarefa" name="nome_tarefa" required>
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                            </div>
                            <!-- <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="iniciar">Iniciar</option>
                                    <option value="em_andamento">Em Andamento</option>
                                    <option value="pausada">Pausada</option>
                                    <option value="finalizado">Finalizado</option>
                                </select>
                            </div> -->
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <a href="{{ route('tarefas.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
