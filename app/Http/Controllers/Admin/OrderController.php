<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order; // Add this line to import the Order model
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::all();
        // var_dump($orders);
        
        $voucher_group = $orders->groupBy('voucher_no')->toArray();
        // dd($voucher_group);
        
        $order_data = [];
        foreach ($voucher_group as $voucher) {
            $orders_id = array_column($voucher, 'id');
            // var_dump($orders_id);
            
            $order_data[] = Order::whereIn('id', $orders_id)->where('status', 'Pending')->first();
        }
        // dd($order_data);
        
        return view('admin.orders.index', compact('order_data'));
    }

    public function orderAccept()
    {
        $orders = Order::all();
        // var_dump($orders);
        
        $voucher_group = $orders->groupBy('voucher_no')->toArray();
        // dd($voucher_group);
        
        $order_data = [];
        foreach ($voucher_group as $voucher) {
            $orders_id = array_column($voucher, 'id');
            // var_dump($orders_id);
            
            $order_data[] = Order::whereIn('id', $orders_id)->where('status', 'Accept')->first();
        }
        // dd($order_data);
        
        return view('admin.orders.index', compact('order_data'));
    }

    public function orderComplete() {
        $orders = Order::all();
        $voucher_group = $orders->groupBy('voucher_no')->toArray();
        foreach($voucher_group as $voucher) {
            $orders_id = array_column($voucher, 'id');
            $order_data[] = Order::whereIn('id', $orders_id)->where('status', 'Complete')->first();
        }
        return view('admin.orders.index', compact('order_data'));
    }
    
    public function orderDetail($voucher) {
        $orders = Order::where('voucher_no', $voucher)->get();
        $order_first = Order::where('voucher_no', $voucher)->first();
        return view('admin.orders.detail', compact('orders', 'order_first'));
    }
    
    public function status(Request $request, $voucher) {
        // dd($request);
        Order::where('voucher_no', $voucher)->update(['status' => $request->status]);
        return redirect()->route('backend.orders');
    }
}
