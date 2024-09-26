<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function list()
    {
        $products = Product::select('products.id', 'products.name','products.description', 'products.price', 'products.stock','products.image_url', 'categories.id as categorie_id', 'categories.name as categorie_name')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->get();

        return Inertia::render('products/Products', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $categories= Categorie::all();
        return Inertia::render('products/Create',[
            'categories' => $categories
        ]);
    }

    public function creating(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:65535',
            'price' => 'required|numeric|min:0',  
            'stock' => 'required|integer|min:0',   
            'categorie.id' => 'required',  
            'imageUrl' => 'nullable|url|max:255', 
        ]);



        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price'=> $request->price,
            'stock'=> $request->stock,
            'category_id'=> $request->categorie['id'],
            'image_url'=> $request->imageUrl
        ]);
        return redirect()->route('products')
        ->with('success', 'product created successfully.');
    }


    public function edit($id)
    {
        $categories= Categorie::all();
        $product = Product::findOrFail($id);
        return Inertia::render('products/Edit', [
            'product' => $product->toArray(),
            'categories' => $categories->toArray()
        ]);
    }


    public function update(Request $request, $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->name = $request['name'];
        $product->description = $request['description'];
        $product->price=$request['price'];
        $product->stock=$request['stock'];
        $product ->category_id = $request->categorie['id'];
        $product ->image_url = $request['imageUrl'];

        $product->save();

        return redirect()->route('products')
            ->with('success', 'Product updated successfully.');
    }



    public function destroy(Request $request): RedirectResponse
    {

        $product = Product::findOrFail($request->id);
        $product->delete();
        return redirect()->route('products')->with('success', 'Product deleted successfully.');
    }
}
