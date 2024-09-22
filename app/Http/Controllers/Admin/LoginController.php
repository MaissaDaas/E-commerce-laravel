<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class LoginController extends Controller
{
    public function showloginform()
    {
        return view('login');
    }

    public function showsgininform()
    {
        return view('register');
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $credentials = $request->only('email', 'password'); 

        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return redirect()->route('login_form')->withErrors(['email' => 'Incorrect email'])->withInput();
        }
    
        if (!Auth::attempt($credentials)) {
            return redirect()->route('login_form')->withErrors(['password' => 'Incorrect password'])->withInput();
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role == 'admin') {
                //dd('loged in');
                return redirect()->route('dashbord');
            }
            else{
                \Log::info('Redirecting to user home');
                return redirect()->route('home');
                // return redirect()->route('admin.home');
                //dd('user');
            }
        }
    }

    public function register(RegisterRequest $request)
    {
        // dd($request->all());
   
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'user',
        ]);

        //dd('success');
        return redirect()->route('login_form')->with('success', 'User successfully registered');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login_form');
    }
}
