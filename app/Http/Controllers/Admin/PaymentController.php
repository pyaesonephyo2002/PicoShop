<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::orderBy('id', 'DESC')->paginate(15);
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


         // dd($request);
         $payments = Payment::create($request->all());
         $payments->save();
 
         return redirect()->route('backend.payments.index');
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        // $path = $request->file('logo')->store('logos', 'public');

        // Payment::create([
        //     'name' => $request->input('name'),
        //     'image' => $path,
        // ]);

        // return redirect()->route('backend.payments.index')->with('success', 'Payment created successfully.');
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
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
    }
}
