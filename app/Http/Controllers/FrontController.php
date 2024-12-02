<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function shop()
    {
        return view('front.shops');
    }

    public function shopItem($id) // Correct spelling of 'function'
    {
        return view('front.shop-item');    
    }
}
