<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        // Création d'une catégorie
        $category = new Category();
        $category->name = $request->name;
        $category->save();
    
        return response()->json(['message' => 'Category created successfully!', 'category' => $category]);

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation échouée', 'errors' => $e->errors()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return response()->json(['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{

        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->name = $request->name;
        $category->save();

        return response()->json(['message' => 'Category updated successfully!', 'category' => $category]);

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation échouée', 'errors' => $e->errors()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        if ($category->getProductCount() > 0) {
            // Supprimer tous les produits associés à la catégorie
            $category->products()->delete();
        }

        $category->delete();

        return response()->json(['message' => 'Category and its products deleted successfully!']);
    }

    /**
     * Get the number of products in a specific category.
     */

    public function countProductsInCategory(string $categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $productCount = $category->getProductCount();

        return response()->json(['product_count' => $productCount]);
    }
}
