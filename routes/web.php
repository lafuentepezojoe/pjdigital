<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarpetasController;
use App\Http\Controllers\ArchivosController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('panel.dashboard');
    })->name('dashboard');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');


// Carpetas
Route::get('/carpeta/create', [CarpetasController::class, 'create'])->name('carpeta.create');
Route::post('/carpeta/store', [CarpetasController::class, 'store'])->name('carpeta.store');
Route::get('/carpeta/destroy/{id_Carpeta}', [CarpetasController::class, 'destroy'])->name('carpeta.destroy');
Route::get('/carpeta/edit/{id_Carpeta}', [CarpetasController::class, 'edit'])->name('carpeta.edit');
Route::post('/carpeta/update', [CarpetasController::class, 'update'])->name('carpeta.update');

// Archivos
Route::get('/archivo/create/{id_carpeta}', [ArchivosController::class, 'create'])->name('archivo.create');
Route::post('/archivo/store/{id_carpeta}', [ArchivosController::class, 'store'])->name('archivo.store');
Route::get('/archivo/destroy/{id_archivo}', [ArchivosController::class, 'destroy'])->name('archivo.destroy');
Route::get('/archivo/edit/{id_archivo}', [ArchivosController::class, 'edit'])->name('archivo.edit');
Route::post('/archivo/update', [ArchivosController::class, 'update'])->name('archivo.update');



Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
