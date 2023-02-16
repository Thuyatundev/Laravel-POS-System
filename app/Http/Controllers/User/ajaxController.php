<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ajaxController extends Controller
{
    // pizza list
    public function pizzaList(Request $request)
    {
        logger($request->all());
        if ($request->status == 'asc') {
            $data = Product::orderBy('created_at', 'asc')->get();
        } else if($request->status == 'desc'){
            $data = Product::orderBy('created_at', 'desc')->get();
        }
        return $data;
    }
}
