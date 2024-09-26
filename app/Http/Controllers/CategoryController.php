<?php

namespace App\Http\Controllers;


use App\Models\Categorie;
use Hamcrest\Description;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;


class CategoryController extends Controller
{

    public function list()
    {
        $categories = Categorie::all();
        return Inertia::render('categories/Categories', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return Inertia::render('categories/Create');
    }
    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);
        return Inertia::render('categories/Edit', [
            'categorie' => $categorie->toArray(),
        ]);
    }


    public function update(Request $request, $id): RedirectResponse
    {
        echo 'llegta aca' . $request . $id;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Categorie::findOrFail($id);
        $category->name = $validated['name'];
        $category->description = $validated['description'];

        $category->save();

        return redirect()->route('categories')
            ->with('success', 'Category updated successfully.');
    }


    public function creating(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:65535',
        ]);

        $categorie = Categorie::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('categories')
            ->with('success', 'Category created successfully.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $category = Categorie::findOrFail($request->id);
        $category->delete();
        return redirect()->route('categories')->with('success', 'Category deleted successfully.');
    }
}
