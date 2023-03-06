<?php

namespace App\Http\Controllers\Route;

use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //test api
    // http://127.0.0.1:8000/api/testing (method => Get)
    public function test()
    {
        $products = Product::get();
        $users = User::get();
        $category = Category::get();
        $contact = Contact::get();

        $data = [
            'product' => [
                'test' => $products
            ],
            'users' => $users,
            'category' => $category,
            'contact' => $contact,
        ];

        return response()->json($data, 200);
    }
}
