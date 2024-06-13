<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return response()->json ($users);
    }

    public function store (Request $request)
    {
        $validator = Validator::make($request->all(),[

            'name'=>'required',
            'email'=>'required', 
            'password'=>'required',
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors()->toJson());
        }
        User::create(array_merge($validator->validated()));
        return response()->json('User is added');
    }

    public function update (Request $request,$id)
    {
        $user=User::findOrFail($id);
        $validator = Validator::make($request->all(),[

            'name'=>'required',
            'email'=>'required', 
            'password'=>'required',
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors()->toJson());
        }
        $user->update(array_merge($validator->validated()));
        return response()->json('User is updated');
    }

    public function destory ($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return response()->json('User is deleted');
    }
}
