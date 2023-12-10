<?php

use App\Http\Controllers\UniversityMajorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('web')->group(function () {
    Route::get('/get-majors-by-university/{university}', [UniversityMajorController::class, 'get_majors_by_university'])
        ->name('api.majors.university');
    Route::get('/get-data-by-major/{major}', [UniversityMajorController::class, 'get_data_by_major'])
        ->name('api.data.major');
});
