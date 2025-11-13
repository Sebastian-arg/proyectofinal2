<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

/**
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer"
 * )
 */
class CursoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/cursos",
     *     summary="Mostrar todos los cursos",
     *     tags={"Cursos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todos los cursos.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Curso")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Curso::all();
    }

    /**
     * @OA\Post(
     *     path="/api/cursos",
     *     summary="Crear un nuevo curso",
     *     tags={"Cursos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Curso")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Curso creado exitosamente.",
     *         @OA\JsonContent(ref="#/components/schemas/Curso")
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
            'docente_id' => 'required|exists:usuarios,id',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'temario' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'cupo' => 'required|integer',
            'precio' => 'required|numeric',
            'estado' => 'required|string|max:50',
        ]);

        $curso = Curso::create($request->all());

        return response()->json($curso, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/cursos/{id}",
     *     summary="Mostrar un curso específico",
     *     tags={"Cursos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el curso especificado.",
     *         @OA\JsonContent(ref="#/components/schemas/Curso")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Curso no encontrado."
     *     )
     * )
     */
    public function show(Curso $curso)
    {
        return $curso;
    }

    /**
     * @OA\Put(
     *     path="/api/cursos/{id}",
     *     summary="Actualizar un curso existente",
     *     tags={"Cursos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Curso")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Curso actualizado exitosamente.",
     *         @OA\JsonContent(ref="#/components/schemas/Curso")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Curso no encontrado."
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación."
     *     )
     * )
     */
    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'docente_id' => 'exists:usuarios,id',
            'nombre' => 'string|max:100',
            'descripcion' => 'string',
            'temario' => 'string',
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
            'cupo' => 'integer',
            'precio' => 'numeric',
            'estado' => 'string|max:50',
        ]);

        $curso->update($request->all());

        return response()->json($curso, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/cursos/{id}",
     *     summary="Eliminar un curso existente",
     *     tags={"Cursos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Curso eliminado exitosamente."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Curso no encontrado."
     *     )
     * )
     */
    public function destroy(Curso $curso)
    {
        $curso->delete();

        return response()->json(null, 204);
    }
}
