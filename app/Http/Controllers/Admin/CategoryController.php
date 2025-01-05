<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        if ($request->hasFile('image')) {
            // Store the image in the public disk under the categories folder
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = $path;
        }
    
        Category::create($validated);
    
        return redirect()
            ->route('backend.categories.index')
            ->with('success', 'Category created successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($request->hasFile('image')) {
            // Delete old image
            if($category->image) {
                Storage::delete('public/' . $category->image);
            }

            // Store new image
            $path = $request->file('image')->store('public/categories');
            $category->image = str_replace('public/', '', $path);
        }

        $category->name = $validated['name'];
        $category->save();

        return redirect()
            ->route('backend.categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            
            // Delete the associated image file if it exists
            if ($category->image) {
                $imagePath = public_path($category->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            
            // Delete the category
            $category->delete();
            
            return redirect()
                ->route('backend.categories.index')
                ->with('success', 'Category deleted successfully');
                
        } catch (\Exception $e) {
            return redirect()
                ->route('backend.categories.index')
                ->with('error', 'Error deleting category: ' . $e->getMessage());
        }
    }
}