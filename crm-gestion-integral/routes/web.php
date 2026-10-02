<?php

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
});
