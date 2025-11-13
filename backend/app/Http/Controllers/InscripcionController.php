<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/inscripciones",
     *     summary="Mostrar todas las inscripciones",
     *     tags={"Inscripciones"},
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todas las inscripciones.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Inscripcion")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Inscripcion::with(['estudiante', 'curso'])->get();
    }

    /**
     * @OA\Post(
     *     path="/api/inscripciones",
     *     summary="Crear una nueva inscripción",
     *     tags={"Inscripciones"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Inscripcion")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Inscripción creada exitosamente.",
     *         @OA\JsonContent(ref="#/components/schemas/Inscripcion")
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
            'estudiante_id' => 'required|exists:usuarios,id',
            'curso_id' => 'required|exists:cursos,id',
            'fecha_inscripcion' => 'required|date',
            'estado' => 'required|string|max:50',
        ]);

        $inscripcion = Inscripcion::create($request->all());

        return response()->json($inscripcion, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/inscripciones/{id}",
     *     summary="Mostrar una inscripción específica",
     *     tags={"Inscripciones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra la inscripción especificada.",
     *         @OA\JsonContent(ref="#/components/schemas/Inscripcion")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Inscripción no encontrada."
     *     )
     * )
     */
    public function show(Inscripcion $inscripcion)
    {
        return $inscripcion->load(['estudiante', 'curso']);
    }

    /**
     * @OA\Put(
     *     path="/api/inscripciones/{id}",
     *     summary="Actualizar una inscripción existente",
     *     tags={"Inscripciones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Inscripcion")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Inscripción actualizada exitosamente.",
     *         @OA\JsonContent(ref="#/components/schemas/Inscripcion")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Inscripción no encontrada."
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación."
     *     )
     * )
     */
    public function update(Request $request, Inscripcion $inscripcion)
    {
        $request->validate([
            'estudiante_id' => 'exists:usuarios,id',
            'curso_id' => 'exists:cursos,id',
            'fecha_inscripcion' => 'date',
            'estado' => 'string|max:50',
        ]);

        $inscripcion->update($request->all());

        return response()->json($inscripcion, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/inscripciones/{id}",
     *     summary="Eliminar una inscripción existente",
     *     tags={"Inscripciones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Inscripción eliminada exitosamente."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Inscripción no encontrada."
     *     )
     * )
     */
    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();

        return response()->json(null, 204);
    }
}
