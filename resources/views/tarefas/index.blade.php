@extends('adminlte::page')

@section('title', 'Lista de Tarefas')

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
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa-solid fa-language" style="margin-right: 5px;"></i> Lista de Tarefas</h3>
        <div class="card-tools d-flex align-items-center">

            <button type="button" class="btn btn-block btn-default btn-sm" onclick="window.location.href='{{ route('tarefas.create') }}'" style="margin-right: 10px;"> 
                <i class="fa-solid fa-plus" style="margin-right: 5px;"></i> Incluir Tarefa 
            </button>

            <a href="#" class="btn btn-sm btn-tool d-sm-inline-block" title="Filtro">
                <i class="fa-solid fa-filter"></i>
            </a>
    
            <a href="#" class="btn btn-sm btn-tool d-sm-inline-block" title="Mais Informações">
                <i class="fas fa-bars"></i>
            </a>

        </div>
    </div>

    @if (count($tarefas) > 0)

        <div class="card-body mr-1">
            <table class="table table-striped datatable dtr-inline mr-1 ml-1">
                <thead>
                    <tr>
                        <th style="width: 35%">Nome</th>
                        <th style="width: 20%">Timer</th>
                        <th style="width: 15%">Criado em</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 20%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tarefas as $tarefa)
                        <tr>
                            <td> {{ $tarefa->nome_tarefa }} </td>
                            <td>
                                @if($tarefa->status == 'em_andamento')

                                    @foreach ($tarefa->timeLogs as $timeLog)
                                        @if($timeLog->end_time == null) 
                                            <div class="timer" id="timer{{ $tarefa->id }}" data-start-time="{{ $timeLog->start_time }}">
                                                {{ $timeLog->start_time }}
                                            </div>
                                        @endif
                                    @endforeach 
                                        @else
                                        {{$tarefa->tempoDecorrido()}}
                                @endif          
                                </td>
                                <td>
                                    {{ $tarefa->created_at->format('d/m/Y') }}
                                </td>
                                <td>
                                @if($tarefa->status == 'iniciar')
                                    <small class="badge badge-info">Iniciar</small>
                                @elseif($tarefa->status == 'em_andamento')
                                    <small class="badge badge-secondary">Em Andamento</small>
                                @elseif($tarefa->status == 'pausada')
                                    <small class="badge badge-warning">Pausado</small>
                                @elseif($tarefa->status == 'finalizado')
                                    <small class="badge badge-success">Finalizado</small>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tarefas.show', $tarefa->id) }}" class="btn btn-sm btn-tool d-sm-inline-block" title="Descrição">
                                    <i class="fa-solid fa-eye" style="color: green"></i>
                                </a>

                                <a href="{{ route('tarefas.edit', $tarefa->id) }}" class="btn btn-sm btn-tool d-sm-inline-block" title="Editar">
                                    <i class="fa-solid fa-pencil" style="color: #008ca5"></i>
                                </a>

                                {{-- Alteração de Status --}}
                                <form action="{{ route('tarefas.status', $tarefa->id) }}" method="POST" class="d-inline" id="statusForm">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="tarefa_id" value="{{$tarefa->id}}">

                                @if($tarefa->status == 'iniciar')
                                <button type="submit" class="btn btn-sm btn-tool d-sm-inline-block" >
                                <i class="fa-regular fa-circle-play"></i>
                                <input type="hidden" name="status" value="em_andamento">
                                </button>
                                <input class="fim" type="hidden" name="stop" id="btn_finalizar" value="ini">
                                @elseif($tarefa->status == 'em_andamento')
                                <button type="submit" class="btn btn-sm btn-tool d-sm-inline-block" >
                                    <i class="fa-solid fa-pause"></i>
                                    <input type="hidden" name="status" value="pausada">
                                </button>
                                <button type="submit" class="btn btn-sm btn-tool d-sm-inline-block" onclick="finalizar()">
                                    <i class="fa-solid fa-stop"></i>
                                    <input class="fim" type="hidden" name="stop" id="btn_finalizar" value="pause">
                                    
                                </button>
                                @elseif($tarefa->status == 'pausada')
                                <button type="submit" class="btn play btn-sm btn-tool d-sm-inline-block">
                                    <i class="fa-solid fa-play"></i>
                                    <input type="hidden" name="status" value="em_andamento">
                                </button>
                                <button type="submit" class="btn btn-sm btn-tool d-sm-inline-block" onclick="finalizar()">
                                    <i class="fa-solid fa-stop"></i>
                                    <input class="fim" type="hidden" name="stop" id="btn_finalizar" value="andamento">
                                    
                                </button>
                                @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
    <div class="row" style="margin: 20px;">
        <div class="callout callout-warning">
            <h5><i class="fa-solid fa-circle-info"></i> Nenhuma tarefa foi encontrada.</h5>
            <p>Cadastre sua tarefa no botão <strong>"Incluir Tarefa"</strong> no canto superior direito</p>
        </div>
    </div>
    @endif
    <div class="card-footer text-right">
        <a href="#" class="btn btn-sm btn-tool">
            <i class="fa-solid fa-circle-info"></i>
        </a>
    </div>
</div>
@stop

@section('js')

    {{-- Script Global --}}
    <script src="{{ asset('../js/utils.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function finalizar() {
            var elementos = document.getElementsByClassName('fim');
            for (var i = 0; i < elementos.length; i++) {
                var elemento = elementos[i];
                elemento.setAttribute('value', 'finalizar');
            }
        }
    </script>

    <!-- <script>
            setInterval(function() {
            document.querySelectorAll('.timer').forEach(function(element) {
                var startTime = new Date(element.getAttribute('data-start-time'));
                atualizarContador(startTime);
            });
        }, 1000);
        function atualizarContador(startTime) {

            var currentTime = new Date();

            var diff = Math.abs(currentTime - startTime) / 1000;
            var hours = Math.floor(diff / 3600);
            var minutes = Math.floor((diff % 3600) / 60);
            var seconds = Math.floor(diff % 60);

            var formattedTime = hours.toString().padStart(2, '0') + ':' +
                                minutes.toString().padStart(2, '0') + ':' +
                                seconds.toString().padStart(2, '0');

            document.querySelector('.timer').innerText = formattedTime;
        }
    </script>            -->



    <script>
    setInterval(function() {
        var timerElements = document.querySelectorAll('.timer');

        timerElements.forEach(function(element) {
            var startTime = new Date(element.getAttribute('data-start-time'));
            atualizarContador(startTime, element.id);
        });
    }, 1000);

    function atualizarContador(startTime, elementId) {
        var currentTime = new Date();

        var diff = Math.abs(currentTime - startTime) / 1000;
        var hours = Math.floor(diff / 3600);
        var minutes = Math.floor((diff % 3600) / 60);
        var seconds = Math.floor(diff % 60);

        var formattedTime = hours.toString().padStart(2, '0') + ':' +
                            minutes.toString().padStart(2, '0') + ':' +
                            seconds.toString().padStart(2, '0');

        var timerElement = document.getElementById(elementId);
        if (timerElement) {
            timerElement.innerText = formattedTime;
        }
    }
</script>

    @stop
