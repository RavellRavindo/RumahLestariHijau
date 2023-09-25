<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profilePage()
    {
        return view('profile');
    }

    public function editProfile()
    {
        $attr = request()->validate([
            'name' => 'required|regex:/^[a-zA-Z \.,]+$/u|max:255',
            'email' => 'required|email|max:255|unique:users,email',
        ]);

        Auth::user($attr)->save();

        return redirect()->route('profile');
    }
}
