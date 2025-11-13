<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Curso::all();
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        return $curso;
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        $curso->delete();

        return response()->json(null, 204);
    }
}
