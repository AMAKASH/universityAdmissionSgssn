<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\ScholershipController;
use App\Http\Controllers\UniversityController;
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



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require_once __DIR__ . '/auth.php';


Route::middleware('web')->group(function () {
    Route::get('/', [BaseController::class, 'index'])->name('landing');
    Route::get('/universities', [UniversityController::class, 'index'])->name('university-list');
    Route::get('/universities/{university}', [UniversityController::class, 'show'])->name('university.show');

    Route::get('/scholerships', [ScholershipController::class, 'index'])->name('scholership-list');
    Route::get('/scholerships/{scholership}', [ScholershipController::class, 'show'])->name('scholership.show');
});
