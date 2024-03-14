<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\CalculaTimeLogService;
use Illuminate\Support\Facades\DB;

class Tarefa extends Model
{
    use HasFactory;

    protected $table = 'tarefas';
    
    protected $fillable = [
        'user_id',
        'nome_tarefa',
        'descricao',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function timeLogs()
    {
        return $this->hasMany(TimeLog::class, 'tarefas_id');
    }

    public function timer()
    {
        $ultimoRegistro = CalculaTimeLogService::calculo($this->id);

        if ($ultimoRegistro === 0) {
            return null;
        }

        return $this->hasOne(TimeLog::class, 'tarefas_id')->where('id', $ultimoRegistro);
    }

    public function tempoDecorrido()
    {
        return DB::table('time_logs')
            ->select(DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time)))) AS tempo_decorrido'))
            ->where('tarefas_id', $this->id)
            ->value('tempo_decorrido');
    }
}

