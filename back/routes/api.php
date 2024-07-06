<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\SedeController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


Route::get('profile', [AuthController::class, 'userProfile'])->middleware(['auth:sanctum']);
Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

Route::resource('/sedes', SedeController::class)->middleware(['auth:sanctum']);
Route::get('/sedes_all', [SedeController::class, 'getAll'])->name('sedes.getAll')->middleware(['auth:sanctum']);

Route::resource('/routes', RouteController::class)->middleware(['auth:sanctum']);
Route::get('/routes_all', [RouteController::class, 'getAll'])->name('routes.getAll')->middleware(['auth:sanctum']);

Route::resource('/clientes', ClientController::class)->middleware(['auth:sanctum']);
Route::get('/clientes_all', [ClientController::class, 'getAll'])->name('clients.getAll')->middleware(['auth:sanctum']);
Route::get('/clientes/search_by_document/{document}', [ClientController::class, 'searchByDocumentNumber'])->name('clients.searchByDocumentNumber')->middleware(['auth:sanctum']);


Route::resource('/loans', LoansController::class)->middleware(['auth:sanctum']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

