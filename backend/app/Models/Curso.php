<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Curso",
 *     type="object",
 *     title="Curso",
 *     description="Modelo de datos para un curso.",
 *     required={"docente_id", "nombre", "descripcion", "temario", "fecha_inicio", "fecha_fin", "cupo", "precio", "estado"},
 *     @OA\Property(property="id", type="integer", format="int64", description="ID único del curso."),
 *     @OA\Property(property="docente_id", type="integer", format="int64", description="ID del docente que imparte el curso."),
 *     @OA\Property(property="nombre", type="string", maxLength=100, description="Nombre del curso."),
 *     @OA\Property(property="descripcion", type="string", description="Descripción detallada del curso."),
 *     @OA\Property(property="temario", type="string", description="Temario del curso."),
 *     @OA\Property(property="fecha_inicio", type="string", format="date", description="Fecha de inicio del curso."),
 *     @OA\Property(property="fecha_fin", type="string", format="date", description="Fecha de finalización del curso."),
 *     @OA\Property(property="cupo", type="integer", description="Número de cupos disponibles."),
 *     @OA\Property(property="precio", type="number", format="float", description="Precio del curso."),
 *     @OA\Property(property="estado", type="string", maxLength=50, description="Estado actual del curso (e.g., 'disponible', 'lleno', 'cancelado')."),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha y hora de creación."),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha y hora de la última actualización.")
 * )
 */
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
