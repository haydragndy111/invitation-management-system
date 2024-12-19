<?php

use App\Http\Controllers\SurveyController;
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

Route::get('/surveys/{survey}/invitation/{invitation}', [SurveyController::class, 'show'])->name('surveys.show');
Route::get('/surveys/{survey}/accept-invitation/{invitation}', [SurveyController::class, 'acceptInvitation'])
    ->name('surveys.accept-invitation');
