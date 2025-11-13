<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Calificacion",
 *     type="object",
 *     title="Calificacion",
 *     description="Modelo de datos para una calificación de una inscripción.",
 *     required={"inscripcion_id", "nota", "fecha", "tipo_evaluacion"},
 *     @OA\Property(property="id", type="integer", format="int64", description="ID único de la calificación."),
 *     @OA\Property(property="inscripcion_id", type="integer", format="int64", description="ID de la inscripción asociada."),
 *     @OA\Property(property="nota", type="number", format="float", description="Nota obtenida."),
 *     @OA\Property(property="fecha", type="string", format="date", description="Fecha de la calificación."),
 *     @OA\Property(property="tipo_evaluacion", type="string", maxLength=50, description="Tipo de evaluación (e.g., 'examen', 'trabajo práctico')."),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha y hora de creación."),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha y hora de la última actualización.")
 * )
 */
class Calificacion extends Model
{
    use HasFactory;

    protected $table = 'calificaciones';

    protected $fillable = [
        'inscripcion_id',
        'nota',
        'fecha',
        'tipo_evaluacion',
    ];

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'inscripcion_id');
    }
}
