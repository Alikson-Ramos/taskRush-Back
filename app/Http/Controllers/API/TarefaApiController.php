<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use App\Models\TimeLog;
use App\Services\TimeLogService;

class TarefaApiController extends Controller
{
    public function index()
    {
        $tarefas = Tarefa::all();
        return response()->json($tarefas);
    }

    public function show($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        return response()->json($tarefa);
    }

    public function store(Request $request)
    {
        $tarefa = Tarefa::create($request->all());
        return response()->json($tarefa, 201);
    }

    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->update($request->all());
        return response()->json($tarefa, 200);
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
        } else {
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
                $timeLogId = TimeLogService::ultimoRegistroSemEndTime($status['tarefa_id']);
    
                $timeLog = TimeLog::find($timeLogId->id);
    
                $timeLog->update([
                    'tarefas_id' => $status['tarefa_id'],
                    'end_time' => now()
                ]);
            }
            $tarefa->update(['status' => $status['status']]);
        }

        return response()->json($tarefa, 201);
    }
}
