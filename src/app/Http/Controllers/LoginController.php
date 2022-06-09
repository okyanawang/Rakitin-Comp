<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {

        $login = request()->input('email');
        if (is_numeric($login)) 
        {
            $field = 'phone';
            request()->merge([$field => $login]);
            $credentials = $request->validate([
                'phone' => 'required',
                'password' => 'required'
            ]);
        }else 
        {
            $credentials = $request->validate([
                'email' => 'required|email:dns',
                'password' => 'required'
            ]);
        }

        if (Auth::attempt($credentials))
        {

            if ($request->get('remember'))
            {
                $user = Auth::getProvider()->retrieveByCredentials($credentials);
                auth()->login($user, true);
            }
            
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        
        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        
        $request->session()->regenerate();
        
        return redirect('/login');
    }
}
