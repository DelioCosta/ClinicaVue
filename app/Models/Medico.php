<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medico extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'medicos';
    protected $fillable = ['nome','crm'];

    public static $storeRules = [
        'nome' => 'required|min:4',
        'crm' => 'required|numeric'
    ];

    public static $updateRules = [
        'nome' => 'filled|min:4',
        'crm' => 'filled|numeric'
    ];

    public function consultas(): HasMany {
        return $this->hasMany(Consulta::class);
    }
}
