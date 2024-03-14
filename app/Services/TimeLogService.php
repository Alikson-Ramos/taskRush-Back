<?php

namespace App\Services;

use App\Models\TimeLog;
use Illuminate\Support\Facades\DB;

class TimeLogService
{
    public static function ultimoRegistroSemEndTime($id)
    {
        $query = DB::table('time_logs')
            ->select('id')
            ->where('tarefas_id', '=', $id) 
            ->whereNull('end_time')
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();

        $result = $query->toArray();

        return $result[0];
    }
}
