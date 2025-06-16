<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartidoController;

// 🔹 Páginas públicas
Route::view('/', 'index')->name('index');
Route::view('/nosotros', 'nosotros')->name('nosotros');
Route::view('/login', 'login')->name('login');
Route::view('/registrarse', 'registrarse')->name('registrarse');
Route::view('/contacto', 'contacto')->name('contacto');

// 🔹 Rutas de autenticación
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// 🔹 Registro personalizado
// 🔹 Probar correo con MailHog
Route::get('/probar-correo', function () {
    Mail::raw('Este es un correo de prueba desde Laravel con MailHog.', function ($msg) {
        $msg->to('tenismesarivasvaciamadrid@gmail.com')->subject('Correo de prueba');
    });
    return 'Correo enviado correctamente.';
});

// 🔹 Rutas protegidas por rol 'mantenimiento'
Route::middleware(['auth', 'role:mantenimiento'])->group(function () {
    // Administración de usuarios
    Route::get('/usuarios', [AdminController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [AdminController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [AdminController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{id}/edit', [AdminController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [AdminController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [AdminController::class, 'destroy'])->name('usuarios.destroy');
    Route::get('/usuarios/{id}', [AdminController::class, 'show'])->name('usuarios.show');
});

// 🔹 Noticias y eventos (solo mantenimiento y admin_noticias)
Route::middleware(['auth', 'role:mantenimiento,admin_noticias'])->group(function () {
    Route::resource('/noticias', PostController::class);
    Route::resource('/eventos', PostController::class);
});

// 🔹 Resultados (mantenimiento y capitanes)
Route::middleware(['auth', 'role:mantenimiento,capitan'])->group(function () {
    Route::resource('/resultados', PostController::class);
});

// 🔹 Vista de equipos (abierta para cualquier autenticado)
Route::middleware(['auth'])->group(function () {
    Route::view('/equipos', 'equipos.index')->name('equipos');
});

// 🔹 CRUD de Partidos
Route::middleware(['auth'])->group(function () {

    // Crear, editar, eliminar solo mantenimiento y capitan
    Route::middleware(['role:mantenimiento,capitan'])->group(function () {
        Route::get('partidos/create', [PartidoController::class, 'create'])->name('partidos.create');
        Route::post('partidos', [PartidoController::class, 'store'])->name('partidos.store');
        Route::get('partidos/{partido}/edit', [PartidoController::class, 'edit'])->name('partidos.edit');
        Route::put('partidos/{partido}', [PartidoController::class, 'update'])->name('partidos.update');
        Route::delete('partidos/{partido}', [PartidoController::class, 'destroy'])->name('partidos.destroy');
    });

    // Mostrar todos los partidos (index, show)
    Route::get('partidos', [PartidoController::class, 'index'])->name('partidos.index');
    Route::get('partidos/{partido}', [PartidoController::class, 'show'])->name('partidos.show');

    // 🔹 Nueva ruta para actualizar sets individualmente
    Route::put('partido-detalle/{id}', [\App\Http\Controllers\PartidoDetalleController::class, 'update'])->name('detalles.update');
});
// Noticias
Route::get('/admin/noticias', [AdminController::class, 'noticiasIndex'])->name('admin.noticias');
Route::get('/admin/noticias/create', [AdminController::class, 'noticiaCreate'])->name('admin.noticia.create');
Route::post('/admin/noticias', [AdminController::class, 'noticiaStore'])->name('admin.noticia.store');
Route::delete('/admin/noticias/{id}', [AdminController::class, 'noticiaDestroy'])->name('admin.noticia.destroy');
// 🔹 Eventos (solo accesibles por mantenimiento y admin_events)
Route::middleware(['auth', 'role:mantenimiento,admin_events'])->group(function () {

    Route::get('/admin/eventos/create', [AdminController::class, 'eventoCreate'])->name('admin.evento.create');
    Route::post('/admin/eventos', [AdminController::class, 'eventoStore'])->name('admin.evento.store');
    Route::get('/admin/eventos/{id}/edit', [AdminController::class, 'eventoEdit'])->name('admin.evento.edit');
    Route::put('/admin/eventos/{id}', [AdminController::class, 'eventoUpdate'])->name('admin.evento.update');
    Route::delete('/admin/eventos/{id}', [AdminController::class, 'eventoDestroy'])->name('admin.evento.destroy');
    // Noticias
    Route::get('/admin/noticias/create', [AdminController::class, 'noticiaCreate'])->name('admin.noticia.create');
    Route::post('/admin/noticias', [AdminController::class, 'noticiaStore'])->name('admin.noticia.store');
    Route::delete('/admin/noticias/{id}', [AdminController::class, 'noticiaDestroy'])->name('admin.noticia.destroy');
    Route::get('/admin/noticias/{id}/edit', [AdminController::class, 'noticiaEdit'])->name('admin.noticia.edit');
    Route::put('/admin/noticias/{id}', [AdminController::class, 'noticiaUpdate'])->name('admin.noticia.update');
});
Route::get('/admin/eventos', [AdminController::class, 'eventosIndex'])->name('admin.eventos');
Route::get('/admin/eventos/{id}', [AdminController::class, 'eventoShow'])->name('admin.evento.show');
Route::get('/admin/noticias', [AdminController::class, 'noticiasIndex'])->name('admin.noticias');
Route::get('/admin/noticias/{id}', [AdminController::class, 'noticiaShow'])->name('admin.noticia.show');