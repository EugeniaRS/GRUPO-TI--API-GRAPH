<?php

use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\Intervalo90Controller;
use App\Http\Controllers\DetallAnuncio;
use App\Http\Controllers\DetalleAnuncio2;
use App\Http\Controllers\Slider;
// use App\Htpp\Controllers\DetallAnuncio;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/anuncio', [AnuncioController::class, 'index']) -> name('anuncio');

// filtro
//  Route::get('/detalle-anuncio',[DetallAnuncio::class, 'detalle']) -> name('detalle-anuncio');
// Route::get('/detalle-anuncio', [DetallAnuncio::class,'filter']) -> name('detalle-anuncio');
Route::get('/detalle-anuncio/{ad_id}',[DetalleAnuncio2::class, 'filtro']) -> name('detalle-anuncio');
Route::get('/',[Slider::class, 'slider']) -> name('/');
Route::get('/adstime',[Intervalo90Controller::class,'index']) -> name('adstime');
// Route::get('/anuncio',[AnunciooController::class, 'index']) -> name('anuncio');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* Route::get('/detalle-anuncio', function(){
    return view('detalle-anuncio');
})-> name('detalle-anuncio'); */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
