<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paciente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pacientes';
    protected $fillable = ['nome', 'sexo', 'data_nascimento', 'foto', 'contador'];

    public static $storeRules = [
        'nome' => 'required|min:4',
        'data_nascimento' => 'required|date',
        'foto' => 'mimes:jpg,png'
    ];

    public static $updateRules = [
        'nome' => 'filled|min:4',
        'data_nascimento' => 'filled|date',
        'foto' => 'mimes:jpg,png'
    ];

    public function consultas(): HasMany {
        return $this->hasMany(Consulta::class);
    }
}
