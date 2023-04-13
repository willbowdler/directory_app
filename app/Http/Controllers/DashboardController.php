<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function show()
    {
        $users = User::orderBy('name');

        if (request('search')) {
            $users->where('name', 'like', '%' . request('search') . '%');
        }

        return view('directory.index', [
            'users' => $users->get()
        ]);
    }
}
