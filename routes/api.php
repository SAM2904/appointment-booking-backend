<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\AvailabilityController;
use App\Http\Controllers\Api\BookingController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/services', [HomeController::class, 'services']);
Route::get('/weekdays', [HomeController::class, 'weekdays']);

Route::get('/admin/working-hours/list', [AdminController::class, 'getWorkingHoursList']);
Route::post('/admin/working-hours/store', [AdminController::class, 'storeWorkingHours']);

Route::get('/availability', [AvailabilityController::class, 'getAvailability']);
Route::post('/bookings', [BookingController::class, 'store']);
