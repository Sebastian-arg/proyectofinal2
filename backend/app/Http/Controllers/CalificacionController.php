<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    public function index()
    {
        return Calificacion::with(['inscripcion.estudiante', 'inscripcion.curso'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'inscripcion_id' => 'required|exists:inscripciones,id',
            'calificacion' => 'required|numeric|min:0|max:10',
            'comentario' => 'nullable|string',
        ]);

        $calificacion = Calificacion::create($request->all());

        return response()->json($calificacion, 201);
    }

    public function show(Calificacion $calificacion)
    {
        return $calificacion->load(['inscripcion.estudiante', 'inscripcion.curso']);
    }

    public function update(Request $request, Calificacion $calificacion)
    {
        $request->validate([
            'inscripcion_id' => 'exists:inscripciones,id',
            'calificacion' => 'numeric|min:0|max:10',
            'comentario' => 'nullable|string',
        ]);

        $calificacion->update($request->all());

        return response()->json($calificacion, 200);
    }

    public function destroy(Calificacion $calificacion)
    {
        $calificacion->delete();

        return response()->json(null, 204);
    }
}
