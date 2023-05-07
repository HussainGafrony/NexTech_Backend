<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);
        $product = new products;
        if (isset($request->image)) {
            $image = $request->image;
            $photo_name = time() . rand() . '.' . $image->getClientOriginalExtension();
            $image->move('product', $photo_name);
            $product->create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => 'product/' . $photo_name,
                'price' => $request->price,
                'QTY' => $request->QTY,
                'category_id' => $request->category_id,

            ]);
        } else {
            $product->create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'QTY' => $request->QTY,
                'category_id' => $request->category_id,

            ]);
        }

        return response(['created' => Response::HTTP_CREATED]);
    }

    public function update(Request $request)
    {
        $product = products::find($request->id);
        if (isset($request->image)) {
            $image = $request->image;
            $photo_name = time() . rand() . '.' . $image->getClientOriginalExtension();
            $image->move('product', $photo_name);
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'image' => 'product/' . $photo_name,
                'price' => $request->price,
                'QTY' => $request->QTY,
                'category_id' => $request->category_id,

            ]);
        } else {
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'QTY' => $request->QTY,
                'category_id' => $request->category_id,

            ]);
        }
        return response(['Updated' => Response::HTTP_ACCEPTED, 'Product' => $product]);
    }

    public function destroy(Request $request)
    {
        $product = products::find($request->id);
        unlink($product->image);
        $product->delete();

        return response(['Deleted' => Response::HTTP_OK]);
    }

    public function search($word)
    {
        $paginate = request()->header('paginate');
        $product = products::where('name', 'like', '%' . $word . '%');
        return response(['Search' => Response::HTTP_OK, 'Product' => $product->paginate($paginate)]);
    }


}
