<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TarefaApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tarefas', [TarefaApiController::class, 'index']);
Route::get('/tarefas/{id}', [TarefaApiController::class, 'show']);
Route::post('/tarefas', [TarefaApiController::class, 'store']);
Route::put('/tarefas/{id}', [TarefaApiController::class, 'update']);
Route::post('/tarefas/status', [TarefaApiController::class, 'status']);

