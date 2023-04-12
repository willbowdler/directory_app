<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

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
    $users = User::orderBy('name');

    if (request('search')) {
        $users->where('name', 'like', '%' . request('search') . '%');
    }

    return view('directory.index', [
        'users' => $users->get()
    ]);
});

Route::get('/users/create', function () {
    return view('users.create');
});
Route::post('/user/create', function () {
    return view('vsd');
});
