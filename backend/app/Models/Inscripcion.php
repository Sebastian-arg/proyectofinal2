<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Inscripcion",
 *     type="object",
 *     title="Inscripcion",
 *     description="Modelo de datos para una inscripción a un curso.",
 *     required={"estudiante_id", "curso_id", "fecha_inscripcion", "estado"},
 *     @OA\Property(property="id", type="integer", format="int64", description="ID único de la inscripción."),
 *     @OA\Property(property="estudiante_id", type="integer", format="int64", description="ID del estudiante inscrito."),
 *     @OA\Property(property="curso_id", type="integer", format="int64", description="ID del curso al que se inscribe."),
 *     @OA\Property(property="fecha_inscripcion", type="string", format="date", description="Fecha de inscripción."),
 *     @OA\Property(property="estado", type="string", maxLength=50, description="Estado de la inscripción (e.g., 'activa', 'cancelada')."),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha y hora de creación."),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha y hora de la última actualización.")
 * )
 */
class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';

    protected $fillable = [
        'estudiante_id',
        'curso_id',
        'fecha_inscripcion',
        'estado',
    ];

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}
