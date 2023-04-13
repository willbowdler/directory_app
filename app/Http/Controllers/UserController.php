<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:20',
            'marital_status' => 'required|string|max:20',
            'birthday' => 'required|date',
        ]);


        User::create($data);

        return view('users.create');
    }

    public function find_one(User $user)
    {
        return response()->json($user);
    }
}
