<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //addCart
    public function pizzaCart()
    {
        $cartList = Cart::select('carts.*','products.name as pizzaName', 'products.price  as pizzaPrice')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();
        $totalPrice = 0;

        foreach ($cartList as $cart) {
           $totalPrice += $cart->pizzaPrice * $cart->qty;
        }
        return view('user.cart.pizzaCart',compact('cartList','totalPrice'));
    }
}
