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
        // $credentials = request(['email', 'password']); 
        
        // Validate the form data
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        // dd($request->all());

        $validated = $request->validated();

        // Extraire les informations d'identification de la requête
        $credentials = $request->only('email', 'password'); 


        // Vérifier si l'email est correct
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return redirect()->route('login_form')->withErrors(['email' => 'Incorrect email'])->withInput();
        }
    
        // Vérifier si le mot de passe est correct
        if (!Auth::attempt($credentials)) {
            return redirect()->route('login_form')->withErrors(['password' => 'Incorrect password'])->withInput();
        }


        // Se connecter avec les informations d'identification
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role == 'admin') {
                //dd('loged in');
                return redirect()->route('dashbord');
            }
            else{
                dd('user');
                // Auth::logout();
                // return response()->json('you are not an admin', 403);
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
    
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login_form');

       // return redirect('login_form');
    }
}
