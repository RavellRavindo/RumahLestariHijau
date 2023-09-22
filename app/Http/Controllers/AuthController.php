<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function registerPage()
    {
        return view('registration');
    }

    public function loginPage()
    {
        return view('login');
    }

    public function register()
    {
        $attr = request()->validate([
            'name' => 'required|regex:/^[a-zA-Z \.,]+$/u|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:7|max:255',
        ]);

        $user = User::create([
            'name' => $attr['name'],
            'email' => $attr['email'],
            'password' => bcrypt($attr['password']),
            'isAdmin' => '0',
        ]);

        Auth::login($user);

        return redirect()->route('home')->withSuccess('Successfully signed in');
    }

    public function login()
    {
        $attr = request()->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:7|max:255',
        ]);

        $auth = $attr->only('email', 'password');

        if(!Auth::attempt($auth)){
            throw ValidationException::withMessages([
                'email' => "Email is not registered",
                'password' => "Wrong Password"
            ]);
        }

        if (Auth::user()->userType == 'admin')
            return redirect()->route('admin');

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();

        $session = request()->session();
        $session->invalidate();
        $session->regenerateToken();

        return redirect()->route('home');
    }
}
