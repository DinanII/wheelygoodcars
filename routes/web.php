<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\CarController;
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
})->name('home');

Route::middleware('auth')->group(function () {
    Route::post('/cars/create/validateLicense', [CarController::class,'validateLicense'])->name('cars.create.validateLicense');
    Route::get('/cars/create/carInfo/{license}',[CarController::class,'create2Form'])->name('cars.create.carInfo');
    Route::resource('cars', CarController::class);
    Route::get('cars/profile/{userId}/cars', [CarController::class, 'profile'])->name('profile.cars');
});

require __DIR__ . '/auth.php';
