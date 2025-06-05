<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
});

Route::get('/adminproyectos', function () {
    return Inertia::render('Adminproyectos');
})->middleware(['auth', 'verified'])->name('adminproyectos');

Route::get('/listaproyectos', function () {
    return Inertia::render('Listaproyectos');
})->middleware(['auth', 'verified'])->name('listaproyectos');

Route::get('/detallesproyectos', function () {
    return Inertia::render('Detallesproyectos');
})->middleware(['auth', 'verified'])->name('detallesproyectos');

Route::get('/admintareas', function () {
    return Inertia::render('Admintareas');
})->middleware(['auth', 'verified'])->name('admintareas');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);
});

require __DIR__.'/auth.php';
