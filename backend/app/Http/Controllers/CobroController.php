<?php

namespace App\Http\Controllers;

use App\Models\Cobro;
use Illuminate\Http\Request;

class CobroController extends Controller
{
    public function index()
    {
        return Cobro::with(['inscripcion'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'inscripcion_id' => 'required|exists:inscripciones,id',
            'monto' => 'required|numeric',
            'fecha_pago' => 'required|date',
            'metodo_pago' => 'required|string|max:50',
        ]);

        $cobro = Cobro::create($request->all());

        return response()->json($cobro, 201);
    }

    public function show(Cobro $cobro)
    {
        return $cobro->load(['inscripcion']);
    }

    public function update(Request $request, Cobro $cobro)
    {
        $request->validate([
            'inscripcion_id' => 'exists:inscripciones,id',
            'monto' => 'numeric',
            'fecha_pago' => 'date',
            'metodo_pago' => 'string|max:50',
        ]);

        $cobro->update($request->all());

        return response()->json($cobro, 200);
    }

    public function destroy(Cobro $cobro)
    {
        $cobro->delete();

        return response()->json(null, 204);
    }
}
