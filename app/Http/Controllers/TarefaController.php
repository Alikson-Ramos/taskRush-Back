<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use App\Models\TimeLog;

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

    public function edit($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        return view('tarefas.edit', compact('tarefa'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'user_id' => 'required',
        //     'nome_tarefa' => 'required',
        // ]);
        // dd($request->all());
        Tarefa::create($request->all());

        return redirect()->route('tarefas.index');
    }

    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->update($request->all());
        $mensagem = 'Tarefa <strong>' . $tarefa->nome_tarefa . '</strong> atualizada com sucesso!';
        return redirect()->route('tarefas.index')->with('msgSuccess', $mensagem);
    }

    public function destroy(Request $request)
    {
        $id = $request->input('destroy_id');
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->delete();
        $mensagem = 'Tarefa <strong>' . $tarefa->nome_tarefa . '</strong> excluída com sucesso!';
        return redirect()->route('tarefas.index')->with('msgSuccess', $mensagem);
    }

    public function status(Request $request)
    {
        $status = $request->all();
        $tarefa = Tarefa::findOrFail($status['tarefa_id']);

        if($status['status'] == 'iniciar'){
            $timeLog = TimeLog::create([
                'tarefas_id' => $status['tarefa_id'],
                'start_time' => now()
            ]);
        }else if($status['status'] == 'em_andamento'){
            $timeLog = TimeLog::create([
                'tarefas_id' => $status['tarefa_id'],
                'start_time' => now()
            ]);
        }else if($status['status'] == 'pausada'){
            $timeLog = Tarefa::ultimoRegistroSemEndTime();
            $timeLog->update([
                'tarefas_id' => $status['tarefa_id'],
                'end_time' => now()
            ]);
        }

        $tarefa->update(['status' => $status['status']]);
        $mensagem = 'Status da tarefa <strong>' . $tarefa->nome_tarefa . '</strong> alterada com sucesso!';
        return redirect()->route('tarefas.index')->with('msgSuccess', $mensagem);
    }

    public function finalizar($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->update(['status' => 'finalizado']);
        $mensagem = 'Tarefa <strong>' . $tarefa->nome_tarefa . '</strong> finalizada com sucesso!' ;
        return redirect()->route('tarefas.index')->with('msgSuccess', $mensagem);
    }
}

