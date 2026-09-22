<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\ThirdController;
use App\Http\Controllers\WorksheetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// All endpoints below expose customer/worksheet/third business data, so they
// require an authenticated Sanctum session, same as their web-route counterparts.
// Previously these only had the default "api" middleware and were reachable by anyone.
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(['auth:sanctum']);

// Thirds
Route::prefix('third')->middleware(['api', 'auth:sanctum'])->group(function () {
    Route::get('/nit/{nit}', [ThirdController::class, 'findNit']);
});

// Worksheets
Route::prefix('worksheet')->middleware(['api', 'auth:sanctum'])->group(function () {
    Route::get('/{customer}/{period}', [WorksheetController::class, 'search']);
    Route::get('/opened', [WorksheetController::class, 'getOpenedWorksheets']);
    Route::get('/with-processes', [WorksheetController::class, 'getWorksheetWithProcesses']);
});

// Processes
Route::prefix('process')->middleware(['api', 'auth:sanctum'])->group(function () {
    Route::get('/all/{ids}', [ProcessController::class, 'all']);
});

// Customers
Route::prefix('customer')->middleware(['api', 'auth:sanctum'])->group(function () {
    Route::get('/', [CustomerController::class, 'all']);
    Route::get('/{customer}', [CustomerController::class, 'search']);
});
