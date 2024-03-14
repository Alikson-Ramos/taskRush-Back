<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    use HasFactory;

    protected $table = 'time_logs'; 
    
    protected $fillable = [
        'tarefas_id',
        'start_time',
        'end_time',
    ];

    public function tarefa()
    {
        return $this->belongsTo(Tarefa::class, 'tarefas_id');
    }

    
}

