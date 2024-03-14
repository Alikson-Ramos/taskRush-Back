<?php

namespace App\Services;

use App\Models\TimeLog;
use Illuminate\Support\Facades\DB;

class CalculaTimeLogService
{
    public static function calculo($id)
    {
        $query = DB::table('time_logs')
            ->where('tarefas_id', '=', $id) 
            ->whereNull('end_time')
            ->orderBy('id', 'desc')
            ->first();
        return $query;
    }
}
