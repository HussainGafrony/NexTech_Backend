<?php

namespace App\Http\Controllers;

use App\Models\address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

  
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
        if (str_contains($email, 'Super')) {
            $state = 1;
        } else {
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

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
        } catch (ValidationException $exception) {
            return response(['error' => $exception->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if (!Auth::attempt($credentials)) {
            return response(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response(['error' => 'User does not exist'], Response::HTTP_NOT_FOUND);
        }
        $address = address::where('user_id', $user->id)->where('default', '=', 0)->where('default', '=', 1)->first();

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        return response(['user' => auth()->user(), 'access_token' => $token, 'address' => $address]);

    }

    public function update(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        $user->update([
            'firstname' => ($request->firstname) ? $request->firstname : $user->firstname,
            'lastname' => ($request->lastname) ? $request->lastname : $user->lastname,
            'password' => ($request->password) ? Hash::make($request->password) : $user->password,

        ]);
        return response(['Updated' => Response::HTTP_ACCEPTED, 'user' => $user]);

    }
}
