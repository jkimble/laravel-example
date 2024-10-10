<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        // validate, attempt login, regen sess token if success, 301
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        //Auth::attempt($attributes); // returns bool

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.'
            ]);
        }

        request()->session()->regenerate(); //stops session hijacking, MIM

        return redirect('/jobs');
        //return view('auth.register');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
