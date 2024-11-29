<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarpetasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArchivosController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\ProfesoresController;
use App\Http\Controllers\GraficosController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard');
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
Route::post('/carpeta/destroy', [CarpetasController::class, 'destroy'])->name('carpeta.destroy');
Route::get('/carpeta/edit/{id_Carpeta}', [CarpetasController::class, 'edit'])->name('carpeta.edit');
Route::post('/carpeta/update', [CarpetasController::class, 'update'])->name('carpeta.update');


// Archivos
Route::get('/archivo/create/{id_carpeta}', [ArchivosController::class, 'create'])->name('archivo.create');
Route::post('/archivo/store/{id_carpeta}', [ArchivosController::class, 'store'])->name('archivo.store');
Route::post('/archivo/destroy', [ArchivosController::class, 'destroy'])->name('archivo.destroy');
Route::get('/archivo/edit/{id_archivo}', [ArchivosController::class, 'edit'])->name('archivo.edit');
Route::post('/archivo/update', [ArchivosController::class, 'update'])->name('archivo.update');

//Solicitudes
Route::get('/solicitudes/carpetayarchivos', [SolicitudesController::class, 'carpetayarchivos'])->name('solicitudes.carpetayarchivos');
Route::get('/solicitudes/index', [SolicitudesController::class, 'index'])->name('solicitudes.index');
Route::post('/solicitudes/store', [SolicitudesController::class, 'store'])->name('solicitudes.store');
Route::post('/solicitudes/aprobar', [SolicitudesController::class, 'aprobar'])->name('solicitudes.aprobar');
Route::post('/solicitudes/rechazar', [SolicitudesController::class, 'rechazar'])->name('solicitudes.rechazar');
Route::get('/solicitudes/notificaciones', [SolicitudesController::class, 'notificaciones'])->name('solicitudes.notificaciones');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

//Usuarios
Route::get('/usuarios/index', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/edit/{id}', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::post('/usuarios/update/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::post('/usuarios/store', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::delete('/usuarios/destroy/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

//Profesores
Route::post('/profesor/buscar', [ProfesoresController::class, 'buscar'])->name('profesor.buscar');

//Dashboard
Route::get('/graficos/carpetas', [GraficosController::class, 'chart_carpetas'])->name('graficos.carpetas');
Route::get('/graficos/archivos', [GraficosController::class, 'chart_archivos'])->name('graficos.archivos');
Route::get('/graficos/carparch', [GraficosController::class, 'chart_caprarch'])->name('graficos.carparch');


//password reset
Route::post('/usuarios/passwrod/reset/{id}', [UsuarioController::class, 'password_reset'])->name('usuarios.password.reset');
Route::post('/usuarios/reset-password', [UsuarioController::class, 'password_reset'])->name('usuarios.resetPassword');

//leido
Route::get('/marcar-leido', [SolicitudesController::class, 'marcarComoLeido']);
