<?php

use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\IntrantController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
}); 

Route::get('/dashboard',[DashBoardController::class,'index'])->middleware(['auth','verified'])->name('dashboard');

Route::resource('/membres', UserController::class)->middleware(['auth', 'verified']);

Route::resource('/intrants',IntrantController::class)->middleware(['auth', 'verified']);

Route::resource('/materiels',MaterielController::class)->middleware(['auth', 'verified']);


// Route pour AFFICHER le formulaire (Lien cliquable)
Route::get('materiels/{materiel}/reserver', [MaterielController::class, 'createReservation'])->name('materiels.reserver.form');


// Route pour enregistrer la réservation
Route::post('materiels/{materiel}/reserver', [MaterielController::class, 'storeReservation'])->name('materiels.reserver.store');

// Route pour restituer un matériel avant la fin
Route::patch('reservations/{id}/terminer', [MaterielController::class, 'terminerReservation'])->name('reservations.terminer');

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');  */

// Formulaire pour réapprovisionner un intrant précis
Route::get('intrants/{intrant}/reappro', [IntrantController::class, 'editReappro'])->name('intrants.reappro.form');

// Traitement de l'incrémentation du stock
Route::put('intrant/{intrant}/reappro', [IntrantController::class, 'updateReappro'])->name('intrants.reappro.update');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
