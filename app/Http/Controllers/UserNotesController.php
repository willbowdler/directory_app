<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserNotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class UserNotesController extends Controller
{

    public function create(User $user)
    {
        return view('user_notes.index', [
            "user" => $user,
        ]);
    }

    public function store(User $user)
    {
        request()->validate([
            'note' => 'required',
            'title' => 'required'
        ]);

        $data = [
            "user_id" => $user->id,
            "note" => request('note'),
            "title" => request('title'),
            "created_by" => Auth::user()->name,
            "created_date" =>  Carbon::now()
        ];

        UserNotes::create($data);

        return back();
    }

    public function destroy(UserNotes $user_note)
    {
        $user_note->delete();
        return back();
    }
}
