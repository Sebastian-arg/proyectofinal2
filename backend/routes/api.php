<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\CobroController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\AuthController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('cursos', CursoController::class);
Route::apiResource('inscripciones', InscripcionController::class);
Route::apiResource('cobros', CobroController::class);
Route::apiResource('calificaciones', CalificacionController::class);

