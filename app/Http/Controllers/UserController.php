<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'firstname' => 'required|string|max:250',
            'lastname' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'address_line_1' => 'string|required|max:155',
            'city' => 'string|required|max:55',
            'country' => 'string|required|max:55',
            'postcode' => 'integer|required|max:99999',
            'phone' => 'string|required|max:55',
            'street' => 'string|required|max:55',
        ]);
        $state = 0;
        $email = $request->input('email');
        if (str_contains($email,'Super')) {
            $state = 1;
        } else{
            $state = 0;
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $email,
            'password' => Hash::make($request->password),
            'state' => $state,
        ]);
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $adress = address::create([
            'address_line_1' => $request->address_line_1,
            'country' => $request->country,
            'city' => $request->city,
            'phone' => $request->phone,
            'postcode' => $request->postcode,
            'street' => $request->street,
            'default' => false,
            'user_id' => $user->id,
        ]);

        return response(['user' => $user, 'address' => $adress, 'access_token' => $token]);

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }
}