<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|min:3|unique:users,username',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|max:255|min:3',
        ]);

        // hash the password using bcrypt
        // $attributes['password'] = bcrypt($attributes['password']);

        // flash a message 
        // session()->flash('success', 'Your account has been created.');

        $user = User::create($attributes);

        auth()->login($user);

        return redirect('/')->with('success', 'Your account has been created.');
    }
}
