<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function show()
    {
        $gate = app(\Illuminate\Contracts\Auth\Access\Gate::class);

        if ($gate->allows('view_notes')) {
            $users = User::with('user_notes')->orderBy('name');
        } else {
            $users = User::orderBy('name');
        }

        if (request('search')) {
            $users->where('name', 'like', '%' . request('search') . '%');
        }

        return view('directory.index', [
            'users' => $users->get()
        ]);
    }
}
