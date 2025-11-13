<?php

namespace App\Http\Controllers;

use App\Models\Cobro;
use Illuminate\Http\Request;

/**
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer"
 * )
 */
class CobroController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/cobros",
     *     summary="Mostrar todos los cobros",
     *     tags={"Cobros"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todos los cobros.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Cobro")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Cobro::with(['inscripcion'])->get();
    }

    /**
     * @OA\Post(
     *     path="/api/cobros",
     *     summary="Crear un nuevo cobro",
     *     tags={"Cobros"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Cobro")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Cobro creado exitosamente.",
     *         @OA\JsonContent(ref="#/components/schemas/Cobro")
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
            'monto' => 'required|numeric',
            'fecha_cobro' => 'required|date',
            'estado_cobro' => 'required|string|max:50',
            'metodo_de_cobro' => 'required|string|max:50',
        ]);

        $cobro = Cobro::create($request->all());

        return response()->json($cobro, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/cobros/{id}",
     *     summary="Mostrar un cobro específico",
     *     tags={"Cobros"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el cobro especificado.",
     *         @OA\JsonContent(ref="#/components/schemas/Cobro")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cobro no encontrado."
     *     )
     * )
     */
    public function show(Cobro $cobro)
    {
        return $cobro->load(['inscripcion']);
    }

    /**
     * @OA\Put(
     *     path="/api/cobros/{id}",
     *     summary="Actualizar un cobro existente",
     *     tags={"Cobros"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Cobro")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cobro actualizado exitosamente.",
     *         @OA\JsonContent(ref="#/components/schemas/Cobro")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cobro no encontrado."
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación."
     *     )
     * )
     */
    public function update(Request $request, Cobro $cobro)
    {
        $request->validate([
            'inscripcion_id' => 'exists:inscripciones,id',
            'monto' => 'numeric',
            'fecha_cobro' => 'date',
            'estado_cobro' => 'string|max:50',
            'metodo_de_cobro' => 'string|max:50',
        ]);

        $cobro->update($request->all());

        return response()->json($cobro, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/cobros/{id}",
     *     summary="Eliminar un cobro existente",
     *     tags={"Cobros"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Cobro eliminado exitosamente."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cobro no encontrado."
     *     )
     * )
     */
    public function destroy(Cobro $cobro)
    {
        $cobro->delete();

        return response()->json(null, 204);
    }
}
