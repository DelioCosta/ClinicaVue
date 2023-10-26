<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Consulta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'consultas';
    protected $casts = ['data' => 'date:Y-m-d'];
    protected $fillable = ['medico_id','paciente_id','data','hora_inicio','hora_fim','valor'];

    protected static function booted(): void
    {
        static::created(function (Consulta $consulta){
            Log:info('Nova consulta criada: '.$consulta);
            $paciente = Paciente::find($consulta->paciente_id);
            $paciente->contador++;
            $paciente->save();
            Log::info('O paciente '.$paciente->nome.' possui '. $paciente->contador. ' consultas.');

        });
    }

    public function paciente() : BelongsTo {
        return $this->belongsTo(Paciente::class);
    }

    public function medico() : BelongsTo {
        return $this->belongsTo(Medico::class);
    }

    public static $storeRules = [
        'medico_id' => 'required',
        'paciente_id' => 'required',
        'data' => 'required|date|after_or_equal:today',
        'hora_inicio' => 'required',
        'hora_fim' => 'required',
        'valor' => 'required|decimal:0,2'
    ];

    public static $updateRules = [
        'medico_id' => 'filled',
        'paciente_id' => 'filled',
        'data' => 'filled|date|after_or_equal:today',
        'hora_inicio' => 'filled',
        'hora_fim' => 'filled',
        'valor' => 'filled|decimal:0,2'
    ];

}
