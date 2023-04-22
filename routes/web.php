<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserNotesController;
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

Route::get('/', [DashboardController::class, 'show'])->middleware('auth');

Route::get('users/create', [UserController::class, 'create']); //->middleware('auth')
Route::post('users/create', [UserController::class, 'store']);
Route::get('users/{user:slug}', [UserController::class, 'find_one']);

Route::get('users/{user}/notes/create', [UserNotesController::class, 'create'])->middleware('can:view_notes');
Route::post('users/{user}/notes/create', [UserNotesController::class, 'store'])->middleware('can:view_notes');
Route::get('users/{user_note}/notes/destroy', [UserNotesController::class, 'destroy'])->middleware('can:view_notes');

Route::get('sessions/create', [SessionController::class, 'create'])->name('login');
Route::post('sessions/create', [SessionController::class, 'store']);
Route::post('sessions/destroy', [SessionController::class, 'destroy'])->name('logout');

Route::get('payments/create', [PaymentController::class, 'create'])->middleware('auth');
Route::post('payments/charge', [PaymentController::class, 'charge'])->middleware('auth');

Route::post('payments/subscription/create', [SubscriptionController::class, 'create'])->middleware('auth');
