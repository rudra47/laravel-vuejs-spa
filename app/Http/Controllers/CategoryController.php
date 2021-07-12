<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Str;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return response()->json($categories, 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return response()->json('success', 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        
    }

    public function edit(Category $category)
    {
        if ($category) {
            return response()->json($category, 200);
        }else {
            return response()->json('failed', 404);
        }
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => "required|unique:categories,name, $category->id"
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return response()->json('success', 200);
    }

    public function destroy(Category $category)
    {
        if ($category) {
            $category->delete();
            return response()->json('success', 200);
        }else {
            return response()->json('failed', 404);
        }
    }
}
