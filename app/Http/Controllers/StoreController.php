<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StoreController extends Controller
{
    public function store()
    {
        $categories = Categorie::all();
        $products = Product::select('products.id', 'products.name', 'products.description', 'products.price', 'products.stock', 'products.image_url', 'categories.id as categorie_id', 'categories.name as categorie_name')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->get();

        return Inertia::render('Store', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function filter(Request $request)
    {
        echo 'llega'. $request;

        if ($request->name == 'All') {
            $categories = Categorie::all();
            $products = Product::select('products.id', 'products.name', 'products.description', 'products.price', 'products.stock', 'products.image_url', 'categories.id as categorie_id', 'categories.name as categorie_name')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->get();

            return Inertia::render('Store', [
                'products' => $products,
                'categories' => $categories
            ]);
        }
        
    }
}
