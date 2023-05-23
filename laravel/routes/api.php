<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TrabajadorController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\Api\ReservaController;
use App\Http\Controllers\Api\ServicioController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\StripeController;
use App\Http\Controllers\Api\EmailController;
use App\Http\Controllers\Api\ProductoController;


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

Route::post('/trabajadores', [TrabajadorController::class, 'store'])->middleware(['auth:sanctum']);
Route::put('/trabajadores/{trabajador}', [TrabajadorController::class, 'update'])->middleware(['auth:sanctum']);
Route::put('/trabajadores/{trabajador}', [TrabajadorController::class, 'destroy'])->middleware(['auth:sanctum']);
Route::get('/trabajadores', [TrabajadorController::class, 'index']);
Route::get('/trabajadores/{trabajador}', [TrabajadorController::class, 'show']);

Route::apiResource('/productos', ProductoController::class)->middleware(['auth:sanctum']);
Route::post('/productos/{producto}', [ProductoController::class, 'update_workaround'])->middleware(['auth:sanctum']);

Route::apiResource('clientes', ClienteController::class)->middleware(['auth:sanctum']);
Route::get('user/cliente', [ClienteController::class, 'obtenerClienteDeUsuario'])->middleware(['auth:sanctum']);
Route::post('/clientes/{cliente}', [ClienteController::class, 'update_workaround'])->middleware(['auth:sanctum']);

Route::apiResource('reservas', ReservaController::class);
Route::get('/user/reservas', [ReservaController::class, 'indexByUser'])->middleware(['auth:sanctum']);
Route::get('/dia/reservas', [ReservaController::class, 'getReservasDia']);
Route::post('/reservas/{reserva}', [ReservaController::class, 'update_workaround']);

Route::post('/servicios', [ServicioController::class, 'store'])->middleware(['auth:sanctum']);
Route::put('/servicios/{servicio}', [ServicioController::class, 'update'])->middleware(['auth:sanctum']);
Route::put('/servicios/{servicio}', [ServicioController::class, 'destroy'])->middleware(['auth:sanctum']);
Route::get('/servicios', [ServicioController::class, 'index']);
Route::get('/servicios/{servicio}', [ServicioController::class, 'show']);

Route::post('/checkout', [StripeController::class, 'checkout']);

Route::post('/send-email', [EmailController::class, 'sendEmail']);