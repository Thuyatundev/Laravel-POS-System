<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
