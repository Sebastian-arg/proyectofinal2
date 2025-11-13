<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index()
    {
        return Inscripcion::with(['estudiante', 'curso'])->get();
    }

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

    public function show(Inscripcion $inscripcion)
    {
        return $inscripcion->load(['estudiante', 'curso']);
    }

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

    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();

        return response()->json(null, 204);
    }
}
