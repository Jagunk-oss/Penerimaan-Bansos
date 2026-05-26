<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenerimaController;
use Illuminate\Support\Facades\Route;

Route::get('/penerima/pdf', [PenerimaController::class, 'exportPdf'])
    ->name('penerima.pdf');
    
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //PROFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    //PENERIMA BANSOS
    Route::resource('penerima', PenerimaController::class);
});


require __DIR__.'/auth.php';
