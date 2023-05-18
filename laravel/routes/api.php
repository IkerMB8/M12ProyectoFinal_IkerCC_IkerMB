<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TrabajadorController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\Api\ReservaController;
use App\Http\Controllers\Api\ServicioController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\StripeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('user', [TokenController::class, 'user'])->middleware(['auth:sanctum']);
Route::post('logout', [TokenController::class, 'logout'])->middleware(['auth:sanctum']);
Route::post('login', [TokenController::class, 'login']);
Route::post('register', [TokenController::class, 'register']);

Route::apiResource('/trabajadores', TrabajadorController::class);
Route::post('/trabajadores/{trabajador}', [TrabajadorController::class, 'update_workaround']);

Route::apiResource('clientes', ClienteController::class);
Route::get('user/cliente', [ClienteController::class, 'obtenerClienteDeUsuario'])->middleware(['auth:sanctum']);;
Route::post('/clientes/{cliente}', [ClienteController::class, 'update_workaround']);

Route::apiResource('reservas', ReservaController::class);
Route::get('/users/{user}/reservas', [ReservaController::class, 'indexByUser']);
Route::get('/dia/reservas', [ReservaController::class, 'getReservasDia']);
Route::post('/reservas/{reserva}', [ReservaController::class, 'update_workaround']);

Route::apiResource('servicios', ServicioController::class);
Route::post('/servicios/{servicio}', [ServicioController::class, 'update_workaround']);

Route::post('/checkout', [StripeController::class, 'checkout']);