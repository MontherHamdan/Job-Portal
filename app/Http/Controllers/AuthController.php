<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        // filled() will return true if the specific value is present or is submitted with the form
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            // intended('/') redirect user for the page he was search for but he was not can saw it cause he was not authenticated
            return redirect()->intended('/');
        } else {
            return redirect()->back()
                ->with('error', 'invalid credentials');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
