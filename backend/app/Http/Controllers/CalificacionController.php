<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use Illuminate\Http\Request;

/**
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer"
 * )
 */
class CalificacionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/calificaciones",
     *     summary="Mostrar todas las calificaciones",
     *     tags={"Calificaciones"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todas las calificaciones.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Calificacion")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Calificacion::with(['inscripcion.estudiante', 'inscripcion.curso'])->get();
    }

    /**
     * @OA\Post(
     *     path="/api/calificaciones",
     *     summary="Crear una nueva calificación",
     *     tags={"Calificaciones"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Calificacion")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Calificación creada exitosamente.",
     *         @OA\JsonContent(ref="#/components/schemas/Calificacion")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación."
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'inscripcion_id' => 'required|exists:inscripciones,id',
            'nota' => 'required|numeric|min:0',
            'fecha' => 'required|date',
            'tipo_evaluacion' => 'required|string|max:50',
        ]);

        $calificacion = Calificacion::create($request->all());

        return response()->json($calificacion, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/calificaciones/{id}",
     *     summary="Mostrar una calificación específica",
     *     tags={"Calificaciones"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra la calificación especificada.",
     *         @OA\JsonContent(ref="#/components/schemas/Calificacion")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Calificación no encontrada."
     *     )
     * )
     */
    public function show(Calificacion $calificacion)
    {
        return $calificacion->load(['inscripcion.estudiante', 'inscripcion.curso']);
    }

    /**
     * @OA\Put(
     *     path="/api/calificaciones/{id}",
     *     summary="Actualizar una calificación existente",
     *     tags={"Calificaciones"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Calificacion")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Calificación actualizada exitosamente.",
     *         @OA\JsonContent(ref="#/components/schemas/Calificacion")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Calificación no encontrada."
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación."
     *     )
     * )
     */
    public function update(Request $request, Calificacion $calificacion)
    {
        $request->validate([
            'inscripcion_id' => 'exists:inscripciones,id',
            'nota' => 'numeric|min:0',
            'fecha' => 'date',
            'tipo_evaluacion' => 'string|max:50',
        ]);

        $calificacion->update($request->all());

        return response()->json($calificacion, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/calificaciones/{id}",
     *     summary="Eliminar una calificación existente",
     *     tags={"Calificaciones"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Calificación eliminada exitosamente."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Calificación no encontrada."
     *     )
     * )
     */
    public function destroy(Calificacion $calificacion)
    {
        $calificacion->delete();

        return response()->json(null, 204);
    }
}
