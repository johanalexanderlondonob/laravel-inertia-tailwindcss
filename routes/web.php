<?php

use App\Http\Controllers\ThirdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorksheetController;
use App\Http\Controllers\WorksheetProcessController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/about', function () {
    return Inertia::render('Dashboard');
})->name('about');

Route::get('/services', function () {
    return Inertia::render('Dashboard');
})->name('services');

Route::get('/contact', function () {
    return Inertia::render('Dashboard');
})->name('contact');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::prefix('worksheet')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', [WorksheetController::class, 'index'])->name('worksheet.index');
    Route::match(['get', 'post'], '/new', [WorksheetController::class, 'create'])->name('worksheet.new');
    Route::get('/{id}', [WorksheetController::class, 'show'])->name('worksheet.show');
    // WorksheetsProcesses
    Route::match(['get', 'post'], '/processes/new', [WorksheetProcessController::class, 'create'])->name('worksheet.processes.new');
});

Route::match(['get', 'post'], '/third/new', [ThirdController::class, 'create'])->name('third.new')->middleware(['auth:sanctum']);

Route::match(['get', 'post'], '/user/new', [UserController::class, 'create'])->name('user.new')->middleware(['auth:sanctum']);
