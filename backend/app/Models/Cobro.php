<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Cobro",
 *     type="object",
 *     title="Cobro",
 *     description="Modelo de datos para un cobro relacionado a una inscripción.",
 *     required={"inscripcion_id", "monto", "fecha_cobro", "estado_cobro", "metodo_de_cobro"},
 *     @OA\Property(property="id", type="integer", format="int64", description="ID único del cobro."),
 *     @OA\Property(property="inscripcion_id", type="integer", format="int64", description="ID de la inscripción asociada."),
 *     @OA\Property(property="monto", type="number", format="float", description="Monto del cobro."),
 *     @OA\Property(property="fecha_cobro", type="string", format="date", description="Fecha en que se realizó el cobro."),
 *     @OA\Property(property="estado_cobro", type="string", maxLength=50, description="Estado del cobro (e.g., 'pagado', 'pendiente', 'vencido')."),
 *     @OA\Property(property="metodo_de_cobro", type="string", maxLength=50, description="Método utilizado para el cobro (e.g., 'tarjeta', 'efectivo')."),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha y hora de creación."),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha y hora de la última actualización.")
 * )
 */
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
