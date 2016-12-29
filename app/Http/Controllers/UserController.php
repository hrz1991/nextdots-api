<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Create user admin with rol_id = 1
     *
     * @return \Illuminate\Http\Response
     */
    public function createAdmin()
    {

        $_new = new User();

        $_new->rol_id = 1;
        $_new->firstname = "Hector";
        $_new->lastname = "Rodriguez";
        $_new->email = "rhector773@gmail.com";
        $_new->password = Hash::make("123456");

        // $_new->save();

        return response()->json($_new);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $_user = User::find($id);

        if (!$_user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        return response()->json($_user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'rol_id' => 'required|integer',
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $_new = new User();

        $_new->rol_id = $request->input('rol_id');
        $_new->firstname = $request->input('firstname');
        $_new->lastname = $request->input('lastname');
        $_new->email = $request->input('email');
        $_new->password = Hash::make($request->input('password'));

        
        $_new->save();

        return response()->json($_new);
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

        $this->validate($request, [
            'rol_id' => 'required|integer',
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email'
        ]);

        $_edit = User::find($id);

        if (!$_edit) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        $_edit->rol_id = $request->input('rol_id');
        $_edit->firstname = $request->input('firstname');
        $_edit->lastname = $request->input('lastname');
        $_edit->email = $request->input('email');

        
        $_edit->save();

        return response()->json($_edit);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $_user = User::find($id);

        if (!$_user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        $_user->delete();

        return response()->json([
            'message' => 'User was deleted',
        ], 200);
    }
}