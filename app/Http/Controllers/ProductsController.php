<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Http\Requests\StoreproductsRequest;
use App\Http\Requests\UpdateproductsRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = products::all();
        return response(['Products' => $products]);
    }


    public function store(StoreproductsRequest $request)
    {
        //
    }


    public function update(UpdateproductsRequest $request, products $products)
    {
        //
    }

}