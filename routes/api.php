<?php

use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\AuthController;
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

Route::resource('medicos', MedicoController::class);
Route::resource('pacientes', PacienteController::class);
Route::post('login', [AuthController::class, 'login']);
