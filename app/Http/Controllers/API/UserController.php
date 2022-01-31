<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::latest()->paginate(10);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nom' => 'required|string|max:20',
            'prenom' => 'required|string|max:20',
            'name' => 'required|string|max:30',
            'email' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:8',
            'numero_CNI' => 'required|string|max:20',
            'statut'=> 'required|string|max:30'
        ]);

        return User::create([
            'nom' => $request['nom'],
            'prenom' => $request['prenom'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'numero_CNI' => $request['numero_CNI'],
            'statut'=> $request['statut']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function profile()
    {
         
        return Auth::user();
        //return auth('api')->user();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);

        $this->validate($request,[
            'nom' => 'required|string|max:20',
            'prenom' => 'required|string|max:20',
            'name' => 'required|string|max:30',
            'email' => 'required|string|max:50|unique:users,email,'.$user->id,
            'password' => 'sometimes|string|min:8',
            'numero_CNI' => 'required|string|max:20',
            'statut'=> 'required|string|max:30'
        ]);
        $user->update($request->all());
        return ['message'=>'User updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);

        $user->delete();

        return ['message' => 'User successfully deleted '];
    }
}
