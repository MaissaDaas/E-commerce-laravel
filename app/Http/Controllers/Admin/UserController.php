<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LoginRequest;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::paginate(10);
        // return response()->json ($users);

        $users = User::all();   // récupère tous les utilisateurs.  est une méthode d'Eloquent, l'ORM (Object-Relational Mapping)
        return view('users', compact('users'));    // Retourne une vue avec les utilisateurs passés en paramètre
        //compact('users') est une fonction PHP qui crée un tableau associatif avec le nom de la variable ($users dans ce cas) comme clé et sa valeur actuelle comme valeur. Cela permet de transmettre la variable $users à la vue en utilisant le même nom.
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
        //return response()->json('User is deleted');
        return redirect()->back();
    }
}




// public function index()
// {
//     // Récupère la première entreprise associée à l'utilisateur connecté
//     $business Business::where('user_id', Auth::id())->first();

//     // Récupère les services associés à cette entreprise et les pagine par 10
//     $services = Service::where('business_id', $business->id)->paginate (10); 

//     return response()->json($services);
// }

// public function index()
// {
//     $booking = Booking::where('user_id', Auth::id())
//         ->with('service')     //Charge les relations avec les services associés pour chaque réservation.
//         ->paginate(10);
//     return response()->json($booking);
// }

// public function store (Request $request)
// {
//      //verifier les données de la requete
//     $validator = Validator::make($request->all(), [
//         'name' => 'required| string | between: 2,100', 
//         'price' => 'required',
//     ]);

//     if($validator->fails()){
//          return response()->json($validator->errors ()->toJson(), 400);
//     }

//     //Cette ligne récupère la première entreprise associée à l'utilisateur actuellement authentifié.
//     $business = Business::where('user_id', Auth::id())->first(); 

//     $service = new Service();
//     $service->name = $request->name;
//     $service->description= $request->description;
//     $service->price = $request->price;
//     $service->business_id = $business->id;
//     $service->user_id = Auth::id();
//     $service->save();
//     return response()->json ('service is added');
// }

// public function update ($id, Request $request)
// {
//     $service = Service::findOrFail($id);
//     $validator = Validator::make($request->all(), [
//         'name' => 'required| string | between: 2,100', 
//         'price' => 'required',
//     ]);

//     if($validator->fails()){
//          return response()->json($validator->errors ()->toJson(), 400);
//     }

//     $service->name = $request->name;
//     $service->description= $request->description;
//     $service->price = $request->price;
//     $service->business_id = $business->id;
//     $service->save();
//     return response()->json ('service is updated');
// }

