<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LoginRequest;

class UserController extends Controller
{
    public function showuser()
    {
        $users = User::all();  
        return view('dashbord.user', compact('users'));    
    }

    public function create(){
        return view('create_user');
    }

    public function store(LoginRequest $request)
    {
        // $validator = Validator::make($request->all(),[

        //     'name'=>'required|string|between:2,100',
        //     'email'=>'required|email|unique:users,email,', 
        //     'password'=>'required',
        //     'role'=>'required'
        // ]);

        $validated = $request->validated();

        if($validator->fails())
        {
            return response()->json($validator->errors()->toJson());
        }

        User::create(array_merge(
            // $validator->validated(),
            $validated,
            ['password' => bcrypt($request->password)]
        ));
        return redirect()->back();

        //return response()->json('User is added');
    }

    public function update(Request $request,$id)
    {
        $user=User::findOrFail($id);
        $validator = Validator::make($request->all(),[

            // $validated = $request->safe()->only(['name', 'email']);
            'name'=>'required|string|between:2,100',
            'email'=>'required|email|unique:users,email,', 
            'password'=>'required',
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors()->toJson());
        }
        $user->update(
            array_merge($validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        
        //return response()->json('User is updated');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('userAdmin');
    }
}
