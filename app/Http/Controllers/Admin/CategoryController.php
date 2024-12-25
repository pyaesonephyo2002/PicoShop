<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
{
    $categories = Category::all();
    return view('admin.categories.create', compact('categories'));
}


    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
     {
         // dd($request);
         $categories = Category::create($request->all());
           $categories->save();

        return redirect()->route('backend.categories.index');
    }






    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Logic for showing the edit form (optional)
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Logic for updating an item (optional)
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Logic for deleting an item (optional)
    }
}
