<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $auth = auth()->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        if ($auth)
        {
            return redirect()->route('dashboard');
        }
        else {
            return response("Login failed!");
//            return redirect()->back()->withInput([
//                'email' => $request->input('email'),
//            ]);
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
