<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\orderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ajaxController extends Controller
{
    // pizza list
    public function pizzaList(Request $request)
    {
        if ($request->status == 'asc') {
            $pizza = Product::orderBy('created_at', 'asc')->get();
        } else if($request->status == 'desc'){
            $pizza = Product::orderBy('created_at', 'desc')->get();
        }
        return response()->json($pizza,200);
    }

    // addTocart
    public function addToCart(Request $request)
    {
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response =[
            'message' => 'Add to Cart Complete',
            'status' =>'success'
        ];
        return response()->json($response,200);
        
    }

    // order
    public function order(Request $request)
    {
        $total = 0;
        foreach($request->all() as $item) 
        {
            
            $data = orderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);

            $total += $data->total;
        }

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total+2500,
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'order complete'
        ],200);
    }

    // clear cart
    public function clear()
    {
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    // crossbtn
    public function crossbtn(Request $request)
    {
        Cart::where('user_id',Auth::user()->id)
            ->where('product_id',$request->productId)
            ->where('id',$request->orderId)
            ->delete();
    }

    // increse view count
    public function increaseViewCount(Request $request)
    {
        $pizza = Product::where('id',$request->productId)->first();

        $viewCount =[
            'view_count'=> $pizza->view_count + 1
        ];

        Product::where('id',$request->productId)->update($viewCount);
    }

    // getOrderData
    private function getOrderData($request)
    {
        return[
            'user_id'=>$request->userId,
            'product_id'=>$request->pizzaId,
            'qty'=>$request->count,
        ];
    }
}
