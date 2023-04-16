<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $data['slug'] = strtolower(str_replace(' ', '', $data['name']));


        User::create($data);

        if (Auth::attempt($data)) {
            return redirect('/');
        }
    }

    public function find_one(User $user)
    {
        $gate = app(\Illuminate\Contracts\Auth\Access\Gate::class);
        $user_data = [
            "name" => $user->name,
            "address" => $user->address,
            "email" => $user->email,
            "phone_number" => $user->phone_number,
            "marital_status" => $user->marital_status,
            "spouse" => $user->spouse,
            "birthday" => $user->birthday,
            "image_URL" => $user->image_URL,
        ];

        if ($gate->allows('view_notes')) {
            $user_data["notes"] = $user->notes;
            $user_data["id"] = $user->id;
        }

        return response()->json($user_data);
    }
}
