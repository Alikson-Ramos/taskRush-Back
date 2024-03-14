<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use App\Models\TimeLog;
use App\Services\TimeLogService;

class TarefaController extends Controller
{
    public function index()
    {
        $tarefas = Tarefa::all();
        return view('tarefas.index', compact('tarefas'));
    }

    public function create()
    {
        return view('tarefas.create');
    }

    public function store(Request $request)
    {
        Tarefa::create($request->all());

        return redirect()->route('tarefas.index');
    }

    public function edit($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        return view('tarefas.edit', compact('tarefa'));
    }

    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->update($request->all());
        $mensagem = 'Tarefa <strong>' . $tarefa->nome_tarefa . '</strong> atualizada com sucesso!';
        return redirect()->route('tarefas.index')->with('msgSuccess', $mensagem);
    }

    public function status(Request $request)
    {
        $status = $request->all();
        $tarefa = Tarefa::findOrFail($status['tarefa_id']);
        if($status['stop'] == 'finalizar'){
            $timeLogId = TimeLogService::ultimoRegistroSemEndTime($status['tarefa_id']);
            if($timeLogId){
                $timeLog = TimeLog::find($timeLogId->id);
                $timeLog->update([
                    'tarefas_id' => $status['tarefa_id'],
                    'end_time' => now()
                ]);
            }
            $tarefa->update(['status' => 'finalizado']);
            $mensagem = 'Tarefa <strong>' . $tarefa->nome_tarefa . '</strong> finalizada com sucesso!' ;
        } else {
            if($status['status'] == 'iniciar'){
                $timeLog = TimeLog::create([
                    'tarefas_id' => $status['tarefa_id'],
                    'start_time' => now()
                ]);
                $mensagem = 'Status da tarefa <strong>' . $tarefa->nome_tarefa . '</strong> iniciada com sucesso!';
            }else if($status['status'] == 'em_andamento'){
                $timeLog = TimeLog::create([
                    'tarefas_id' => $status['tarefa_id'],
                    'start_time' => now()
                ]);
                $mensagem = 'Status da tarefa <strong>' . $tarefa->nome_tarefa . '</strong> executada com sucesso!';
            }else if($status['status'] == 'pausada'){
                $timeLogId = TimeLogService::ultimoRegistroSemEndTime($status['tarefa_id']);
    
                $timeLog = TimeLog::find($timeLogId->id);
    
                $timeLog->update([
                    'tarefas_id' => $status['tarefa_id'],
                    'end_time' => now()
                ]);
                $mensagem = 'Status da tarefa <strong>' . $tarefa->nome_tarefa . '</strong> pausada com sucesso!';
            }
            $tarefa->update(['status' => $status['status']]);
        }
        return redirect()->route('tarefas.index')->with('msgSuccess', $mensagem);
    }
}

