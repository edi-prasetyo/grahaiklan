<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        return view('admin.order.index', compact('orders'));
    }
    function show(int $order_id)
    {
        $order = Order::findOrFail($order_id);

        $product_items = OrderItem::where('order_id', $order_id)
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->select('order_items.*', 'products.name as product_name', 'products.price as product_price', 'products.file_download', 'products.short_description as product_description')
            ->get();
        return view('admin.order.detail', compact('order', 'product_items'));
    }
    function confirmation(Request $request, int $order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->payment_status = $request['payment_status'];
        $order->status = $request['status'];
        $order->update();
        return redirect()->back()->with('message', 'Pembayaran Terkonfirmasi!');
    }
}
