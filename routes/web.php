<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AntesDepoisController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contato', [HomeController::class, 'contato'])->name('contato');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => redirect()->route('admin.contatos'))->name('index');
    Route::get('/contatos', [HomeController::class, 'listarContatos'])->name('contatos');
    Route::get('/antes-depois', [AntesDepoisController::class, 'index'])->name('antes-depois.index');
    Route::post('/antes-depois', [AntesDepoisController::class, 'store'])->name('antes-depois.store');
    Route::delete('/antes-depois/{antesDepois}', [AntesDepoisController::class, 'destroy'])->name('antes-depois.destroy');
});
