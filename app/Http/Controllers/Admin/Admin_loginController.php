<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class Admin_loginController extends Controller
{
    public function showloginform()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // $credentials = request(['email', 'password']); 
        
        // Validate the form data
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        // dd($request->all());

        $credentials = $request->only('email', 'password'); 
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                dd('loged in');

                // return redirect()->route('user.index');
            }
            else{
                dd('user');

                // Auth::logout();
                // return response()->json('you are not an admin', 403);
            }
        }
        return redirect()->route('login_form')->withErrors(['email' => 'Invalid credentials'])->withInput();

        //return redirect('login_form');
    }

    public function register(LoginRequest $request)
    {
   
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }
    
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login_form');

       // return redirect('login_form');
    }
}
