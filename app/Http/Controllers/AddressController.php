<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\address;
use Illuminate\Http\Response;


class AddressController extends Controller
{

    public function index(Request $request)
    {
        $address = address::where('user_id','=', $request->user_id)->get();
        return response(['Address' => $address]);
        // return address::all();
    }
    public function store(Request $request)
    {

        $request->validate([
            'address_line_1' => 'required|string',
            'city' => 'required|string',
            'default' => 'required',
            'country' => 'required|string',
            'postcode' => 'required|integer',
            'phone' => 'required|string',
            'user_id' => 'required'
        ]);
        if ($request->default == 1) {
            $adress = address::where('default', '=', $request->default);
            $adress->update(['default' => 0]);
            $default = 1;
        } else {
            $default = 0;
        }
        $address = new address;

        $address->create([
            'address_line_1' => $request->address_line_1,
            'city' => $request->city,
            'default' => $default,
            'country' => $request->country,
            'postcode' => $request->postcode,
            'phone' => $request->phone,
            'user_id' => $request->user_id

        ]);
        return response(['created' => Response::HTTP_ACCEPTED]);
    }
    public function update(Request $request)
    {


        if ($request->default == 1) {
            $adress = address::where('default', '=', $request->default);
            $adress->update(['default' => 0]);
            $default = 1;
        } else {
            $default = 0;
        }
        $address = address::find($request->id);

        $address->update([
            'address_line_1' => ($request->address_line_1) ? $request->address_line_1 : $address->address_line_1,
            'city' => ($request->city) ? $request->city : $address->city,
            'default' => $default,
            'country' => ($request->country) ? $request->country : $address->country,
            'postcode' => ($request->postcode) ? $request->postcode : $address->postcode,
            'phone' => ($request->phone) ? $request->phone : $address->phone,

        ]);
        return response(['Updated' => Response::HTTP_ACCEPTED, 'Address' => $address]);
    }
}