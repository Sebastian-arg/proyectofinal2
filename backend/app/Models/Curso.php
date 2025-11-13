<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'docente_id',
        'nombre',
        'descripcion',
        'temario',
        'fecha_inicio',
        'fecha_fin',
        'cupo',
        'precio',
        'estado',
    ];

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }
}
