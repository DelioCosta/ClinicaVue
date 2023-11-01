<?php

use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConsultaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('medicos', MedicoController::class)->middleware(['auth:sanctum', 'ability:can-all']);
Route::resource('pacientes', PacienteController::class);
Route::post('login', [AuthController::class, 'login']);
// Route::get('consultas/check', [ConsultaController::class, 'getOne'])->middleware(['auth:sanctum', 'ability:can-all']);
Route::get('consultas/check', [ConsultaController::class, 'getOne']);
