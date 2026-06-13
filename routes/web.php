<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AntesDepoisController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\Admin\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contato', [HomeController::class, 'contato'])->name('contato')->middleware('throttle:5,1');

Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', fn() => redirect()->route('admin.contatos'))->name('index');

    Route::get('/contatos', [ContactController::class, 'index'])->name('contatos');
    Route::patch('/contatos/{id}/atender', [ContactController::class, 'atender'])->name('contatos.atender');
    Route::delete('/contatos/{id}', [ContactController::class, 'destroy'])->name('contatos.destroy');

    Route::get('/servicos', [ServicoController::class, 'index'])->name('servicos.index');
    Route::post('/servicos', [ServicoController::class, 'store'])->name('servicos.store');
    Route::put('/servicos/{servico}', [ServicoController::class, 'update'])->name('servicos.update');
    Route::delete('/servicos/{servico}', [ServicoController::class, 'destroy'])->name('servicos.destroy');

    Route::get('/antes-depois', [AntesDepoisController::class, 'index'])->name('antes-depois.index');
    Route::post('/antes-depois', [AntesDepoisController::class, 'store'])->name('antes-depois.store');
    Route::delete('/antes-depois/{antesDepois}', [AntesDepoisController::class, 'destroy'])->name('antes-depois.destroy');

    Route::get('/galeria', [GaleriaController::class, 'index'])->name('galeria.index');
    Route::post('/galeria', [GaleriaController::class, 'store'])->name('galeria.store');
    Route::put('/galeria/{galeria}', [GaleriaController::class, 'update'])->name('galeria.update');
    Route::delete('/galeria/{galeria}', [GaleriaController::class, 'destroy'])->name('galeria.destroy');
});
