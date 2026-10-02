<?php

<<<<<<< HEAD
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::prefix('reportes')->name('reportes.')->group(function () {
    Route::get('/zonas', [ReportController::class, 'clientesPorZona'])
        ->name('zonas');

    Route::get('/interacciones', [ReportController::class, 'interaccionesPorAsesor'])
        ->name('interacciones');
=======
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
>>>>>>> 85448e644c87cd9fbab3ac34dd49f0922446b323
});
