<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
class ItemController extends Controller
{
    
    public function index()
    {
        $items = Item::orderBy('id', 'DESC')->paginate(15);
        return view('admin.items.index', compact('items'));
    }

    public function create()
{
    $categories = Category::all();
    return view('admin.items.create', compact('categories'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $items = Item::create($request->all());
        $items->save();

        return redirect()->route('backend.items.index');
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
