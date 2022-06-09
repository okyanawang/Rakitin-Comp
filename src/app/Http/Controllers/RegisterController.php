<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|max:255|min:3',
            'email' => 'required|email:dns|unique:account',
            'password' => 'required|min:6|max:255',
            'a_no_hp' => 'required|unique:account',
            'a_alamat' => 'required'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $validated['ap_id'] = 'US';

        if (($user = User::create($validated))){
        
            auth()->login($user);

            return redirect('/login')->with('loginError', 'Login failed!');
        }

        return redirect('/register')->with('failed', 'Register failed!');
    }
}
