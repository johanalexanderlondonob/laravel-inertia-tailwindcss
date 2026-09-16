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

Route::get('/user', function (Request $request) {
    return $request->user();
});

// Thirds
Route::prefix('third')->middleware(['api'])->group(function () {
    Route::get('/nit/{nit}', [ThirdController::class, 'findNit']);
});

// Worksheets
Route::prefix('worksheet')->middleware(['api'])->group(function () {
    Route::get('/{customer}/{period}', [WorksheetController::class, 'search']);
    Route::get('/opened', [WorksheetController::class, 'getOpenedWorksheets']);
    Route::get('/with-processes', [WorksheetController::class, 'getWorksheetWithProcesses']);
});

// Processes
Route::prefix('process')->middleware(['api'])->group(function () {
    Route::get('/all/{ids}', [ProcessController::class, 'all']);
});

// Customers
Route::prefix('customer')->middleware(['api'])->group(function () {
    Route::get('/', [CustomerController::class, 'all']);
    Route::get('/{customer}', [CustomerController::class, 'search']);
});
