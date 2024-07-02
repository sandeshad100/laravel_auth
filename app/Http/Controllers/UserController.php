<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'age' => 'required|numeric',
            'role' => 'required'
        ]);

        $user = User::create($data);


        if ($user) {
            return redirect()->route('login');
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([

            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }
    }
    public function dashboardPage()
    {
        return view('dashboard');
    }
    public function guestPage()
    {
        if (Auth::guest()) {
            return view('guest');
        } else {
            return redirect()->route('dashboard');
        }
    }
    public function logout()
    {
        Auth::logout();
        return view('login');
    }
}
