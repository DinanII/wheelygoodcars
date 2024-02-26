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
    Route::post('/create-step2', [CarController::class,'createStep2'])->name('cars.createStep2');
    Route::resource('cars', CarController::class);
    Route::get('cars/profile/{userId}/cars', [CarController::class, 'profile'])->name('profile.cars');
});

require __DIR__ . '/auth.php';
