<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use LDAP\Result;

class UserController extends Controller
{
    // Register template
    public function create()
    {
        return view('users.register');
    }

    // Register User 
    public function store(Request $request)
    {
        // dd($request);
        $formFields = $request->validate([
            'name'         => ['required', 'min:3'],
            'email'        => ['required', 'email', Rule::unique('users', 'email')],
            'password'     => ['required', 'confirmed', 'min:6']
        ]);

        // Hash Password 
        $formFields['password'] = bcrypt($formFields['password']);

        // Create user
        $user = User::create($formFields);

        // Login 
        auth()->login($user);

        return redirect('/')->with('message', 'User created successfully');
    }

    // Logout User
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'User logout successfully');
    }

    // Login template 
    public function login()
    {
        return view('users.login');
    }

    // Authenticate user credentials 
    public function authenticate(Request $request)
    {
        // dd($request);
        $formFields = $request->validate([
            'email'        => ['required', 'email'],
            'password'     => ['required']
        ]);

        // Authenticate and login if successfull
        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'User logged in successfully');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
