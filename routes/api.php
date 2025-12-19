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

 if (!defined('MIDDLEWARE_CONST')) {
    define('MIDDLEWARE_CONST', 'auth:sanctum');
}

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('validate-token', [AuthController::class, 'validateToken'])->middleware(MIDDLEWARE_CONST);

Route::get('profile', [AuthController::class, 'userProfile'])->middleware(MIDDLEWARE_CONST);
Route::post('logout', [AuthController::class, 'logout'])->middleware(MIDDLEWARE_CONST);

Route::resource('/sedes', SedeController::class)->middleware(MIDDLEWARE_CONST);
Route::get('/sedes_all', [SedeController::class, 'getAll'])->name('sedes.getAll')->middleware(MIDDLEWARE_CONST);

Route::resource('/routes', RouteController::class)->middleware(MIDDLEWARE_CONST);
Route::get('/routes_all', [RouteController::class, 'getAll'])->name('routes.getAll')->middleware(MIDDLEWARE_CONST);

Route::resource('/clientes', ClientController::class)->middleware(MIDDLEWARE_CONST);
Route::get('/clientes_all', [ClientController::class, 'getAll'])->name('clients.getAll')->middleware(MIDDLEWARE_CONST);
Route::get('/clientes/search_by_document/{document}', [ClientController::class, 'searchByDocumentNumber'])->name('clients.searchByDocumentNumber')->middleware(MIDDLEWARE_CONST);


Route::resource('/loans', LoansController::class)->middleware(MIDDLEWARE_CONST);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/export-pdf', [LoansController::class, 'export'])->name('loans.exportPdf');