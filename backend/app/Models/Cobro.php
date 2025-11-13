<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    use HasFactory;

    protected $table = 'cobros';

    protected $fillable = [
        'inscripcion_id',
        'monto',
        'fecha_cobro',
        'estado_cobro',
        'metodo_de_cobro',
    ];

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'inscripcion_id');
    }
}
