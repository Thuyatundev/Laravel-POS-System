<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // order list 
    public function orderlist()
    {
        $order = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->get();
        return view('admin.order.list', compact('order'));
    }

    // orderStatus
    public function orderStatus(Request $request)
    {
        $order = Order::select('orders.*', 'users.name as user_name')
                ->leftJoin('users', 'users.id', 'orders.user_id')
                ->orderBy('created_at','desc');

                if ($request->status == null) {
                   $order = $order->get();
                }else{
                    $order = $order->where('orders.status',$request->status)->get();
                }
                return response()->json($order,200);
    }

    // ajaxChangeStatus
    public function ajaxChangeStatus(Request $request)
    {
        Order::where('id',$request->orderId)->update([
            'status' =>$request->status
        ]);
    }

}
