<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function ultimoRegistroSemEndTime()
    {
        return $this->timeLogs()->whereNull('end_time')->latest()->first();
    }

}

