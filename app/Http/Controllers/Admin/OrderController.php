<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function index()
    {
        // $next_due_date = date('Y-m-d H:i:s', strtotime("+30 days"));
        // $now = date('Y-m-d H:i:s');

        $orders = Order::orderBy('id', 'desc')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('orders.*', 'users.name as customer_name', 'users.phone as customer_phone')

            ->paginate(10);

        // return $next_due_date;
        return view('admin.order.index', compact('orders'));
    }
    function show(int $order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('admin.order.detail', compact('order'));
    }
    // function confirmation(Request $request, int $order_id)
    // {

    //     $order = Order::findOrFail($order_id);

    //     $expired_date = date('Y-m-d H:i:s', strtotime("+$order->active_period days"));

    //     $order->payment_status = $request['payment_status'];
    //     $order->status = $request['status'];
    //     $order->expired_at = $expired_date;
    //     $order->update();
    //     return redirect()->back()->with('message', 'Pembayaran Terkonfirmasi!');
    // }
    function confirmation(Request $request, int $order_id)
    {

        $order = Order::where('id', $order_id)->first();
        $user_id = $order->user_id;

        $order->payment_status = $request['payment_status'];
        $order->status = $request['status'];
        $order->update();

        $user_detail = UserDetail::where('user_id', $user_id)->first();
        $add_count = $user_detail->premium_ads + $order->count;
        $user_detail->premium_ads = $add_count;
        $user_detail->update();

        return redirect()->back()->with('message', 'Pembayaran Terkonfirmasi!');
    }
}
