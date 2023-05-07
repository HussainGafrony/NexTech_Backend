<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Category = category::all();
        return response(['Categoreis' => $Category]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $category = new category;
        if (isset($request->image)) {
            $image = $request->image;
            $photo_name = time() . rand() . '.' . $image->getClientOriginalExtension();
            $image->move('category', $photo_name);
            $category->create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => 'category/' . $photo_name,
            ]);
        } else {
            $category->create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }
        return response(['created' => Response::HTTP_CREATED]);

    }

     public function update(Request $request)
    {
        $category = category::find($request->id);
        if (isset($request->image)) {
            $image = $request->image;
            $photo_name = time() . rand() . '.' . $image->getClientOriginalExtension();
            $image->move('category', $photo_name);
            $category->update([
                'name' => $request->name,
                'description' => $request->description,
                'image' => 'category/' . $photo_name,
            ]);
        } else {
            $category->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }
        return response(['Updated' => Response::HTTP_ACCEPTED, 'Category' => $category]);
    }


    public function destroy(Request $request)
    {
        
        $category = category::find($request->id);
        unlink($category->image);
        $category->delete();

        return response(['Deleted' => Response::HTTP_OK]);
    }
}
