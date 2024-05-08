<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function orders(Request $request)
    {
        $userId = Auth::user()->id;
        $code = Str::uuid()->toString(50);
        $invoice_number = random_int(100000, 999999);
        $order = new Order;
        $order->user_id = $userId;
        $order->customer_name = $request['customer_name'];
        $order->customer_email = $request['customer_email'];
        $order->customer_phone = '0812112233';
        $order->invoice_number = $invoice_number;
        $order->code = $code;
        $order->discount = $request['discount'];
        $order->amount = $request['amount'];
        $order->payment_type = $request['payment_type'];
        $order->payment_status = $request['payment_status'];
        $order->status = $request['status'];

        $order->save();

        $cart = session()->get('cart');
        if (!$cart) {
            return redirect('products/')->with('message', 'Cart Empty');
        } else {
            foreach ($cart as $cart_item) {
                $data[] = [
                    'product_id' => $cart_item['product_id'],
                    'order_id' => $order->id,
                    'amount' => $cart_item['price'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }
        DB::table('order_items')->insert($data);
        $request->session()->forget('cart');

        $userId = Auth::user()->id;

        return redirect('orders/success/' . $order->code)->with('message', 'Order Successfully');
    }

    public function success($code)
    {
        $order = Order::where('code', $code)->first();
        $order_id = $order->id;
        $order_items = DB::table('order_items')->where('order_id', $order_id)
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->select('order_items.*', 'products.name as product_name', 'products.price as product_price', 'products.short_description as product_description')
            ->get();
        // return $order;
        return view('frontend.cart.success', compact('order', 'order_items'));
    }

    function payment($code)
    {
        $order = Order::where('code', $code)->first();
        $order_id = $order->id;
        $banks = Bank::all();
        $order_items = DB::table('order_items')->where('order_id', $order_id)
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->select('order_items.*', 'products.name as product_name', 'products.price as product_price', 'products.short_description as product_description')
            ->get();
        // return $order;
        return view('frontend.member.payment', compact('order', 'order', 'order_items', 'banks'));
    }
}
