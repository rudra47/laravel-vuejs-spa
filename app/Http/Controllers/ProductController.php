<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return response()->json($products, 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required|max:255',
            'price'       => 'required|integer',
            'image'       => 'sometimes|nullable|image|max: 2048',
            'description' => 'required'
        ]);

        $product = Product::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'price'       => $request->price,
            'description' => $request->description
        ]);

        if($request->image){
            $imageName = time().'_'. uniqid() .'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/product'), $imageName);
            $product->image = '/storage/product/' . $imageName;
            $product->save();
        }

        return response()->json('success', 200);

    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        if ($product) {
            return response()->json($product, 200);
        }else {
            return response()->json('failed', 404);
        }
    }

    public function update(Request $request, Product $product)
    {
        // return $request->all();
        $this->validate($request, [
            'name' => "required|unique:products,name, $product->id",
            'price'       => 'required|integer',
            'image'       => 'sometimes|nullable|image|max: 2048',
            'description' => 'required'
        ]);

        $product->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'price'       => $request->price,
            'description' => $request->description
        ]);
        if($request->image){
            $imageName = time().'_'. uniqid() .'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/product'), $imageName);
            $product->image = '/storage/product/' . $imageName;
            $product->save();
        }

        return response()->json($product, 200);
    }

    public function destroy(Product $product)
    {
        if ($product) {
            $imagePath = public_path($product->image);
            $product->delete();
            if ($product->image && file_exists($imagePath)) {
                dd(4, unlink($imagePath));
                unlink($imagePath);
            }
            return response()->json('success', 200);
        }else {
            return response()->json('failed', 404);
        }
    }
}
