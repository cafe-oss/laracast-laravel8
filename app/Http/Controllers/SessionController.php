<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{

    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        //authenticate and login the user based on the provided credentials and redirect with a success flash message 

        // validated
        $attributes = request()->validate([
            // forst approach, this approach has a security issues
            // 'email' => 'required|max:255|email|exists:users,email',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // // second approach, if you provide a valid user, authenticate
        if(auth()->attempt($attributes))
        {
            // avoid session fixation
            session()->regenerate();
            return redirect('/')->with('success', 'Welcome back' . auth()->user()->name . '!');
        }

        // if auth fails
        // return back()->withInput()->withErrors(['email' => 'Your provided credentials could not be verified.' ]);

        // or if auth fails 
        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified.'
         ]);
         
        // final with guard to happy
        if(! auth()->attempt($attributes))
        {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
             ]);
        }

        // avoid session fixation
        session()->regenerate();
        return redirect('/')->with('success', 'Welcome back' . auth()->user()->name . '!');
   
    }


    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You have been successfully logout!');
    }

    
}
