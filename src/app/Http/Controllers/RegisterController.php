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
            'name' => 'required|max:255|min:3',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6|max:255',
            'phone' => 'required|unique:users',
            'address' => 'required'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        
        $validated['role'] = 'customer';

        if (($user = User::create($validated))){
            
            if ($request->get('remember'))
            {
                auth()->login($user, true);
            }else 
            {
                auth()->login($user);
            }
            
            return redirect('/login')->with('loginError', 'Login failed!');
        }

        return redirect('/register')->with('failed', 'Register failed!');
    }
}
