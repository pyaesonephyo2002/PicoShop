<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class FrontController extends Controller
{
    public function shop()
    {
        $items = Item::orderBy('id','DESC')->paginate(8);
        return view('front.shops',compact('items'));
        
    }

    public function shopItem($id) 
    {
        $item = Item::find($id);
        
        return view('front.shop-item', compact('item'));        
    }
}
